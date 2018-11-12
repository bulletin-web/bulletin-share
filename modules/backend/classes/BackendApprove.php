<?php
/**
 * Created by PhpStorm.
 * User: ken
 * Date: 02/02/2018
 * Time: 15:07
 */

namespace Backend\Classes;

use Backend\Facades\BackendAuth;
use Backend\Models\User;
use Backend\Models\WorkFlow;
use RainLab\Blog\Models\Post;
use Db;

class BackendApprove extends Controller
{

    public function getListUser()
    {
        $listUser = [];
        $users = User::whereHas('role', function ($query) {
            $query->where('permissions', 'LIKE', '%backend.blog.approve_post%');
        })->orWhere('is_superuser', '1')
            ->orWhere('role_id', '1')
            ->get();
        if ($users) {
            foreach ($users as $user) {
                $listUser[$user->id] = $user;
            }
        }
        return $listUser;
    }

    public function getCurrentUserList($rule_id)
    {
        $listUserOfRule = $this->getListUserOfRule($rule_id);
        $listAllUser = $this->getListUser();
        foreach ($listUserOfRule as $user) {
            if ($user->type === 'user') {
                unset($listAllUser[$user->id]);
            }
        }
        return $listAllUser;

    }

    public function getListUserOfRule($rule_id)
    {
        $listUser = WorkFlow::find($rule_id)->approve_list;
        return (array)json_decode($listUser);
    }

    public function getUserName($user_id)
    {
        if ($user = User::find($user_id)) {
            return $user->last_name.' '.$user->first_name;
        }
    }

    public function setReviewerId($rule_id) {
        $listUserOfRule = $this->getListUserOfRule($rule_id);
        $listUser = $this->getListUser();
        foreach ($listUserOfRule as $user) {
            if (isset($listUser[$user->id])) {
                return $user->id;
            }
        }
        return 0;
    }

    public function getListUserApproveOfPostWithRuleId($rule_id)
    {
        $listUserOfRule = $this->getListUserOfRule($rule_id);
        $listUser = $this->getListUser();
        foreach ($listUserOfRule as $key => $user) {
            if (!isset($listUser[$user->id])) {
                unset($listUserOfRule[$key]);
            }
        }

        $listCurrentUser = [];
        foreach ($listUserOfRule as $user) {
            $listCurrentUser[] = $user;
        }

        return $listCurrentUser;
    }

    public function getWorkflowStatus($post_id)
    {
        $post = Post::find($post_id);
        $user = User::find($post->reviewer_id);
        $workflow = $post->workflow;
        $approved = 0;
        $count = 0;
        if ($workflow) {
            $count = count((array)json_decode($workflow->approve_list));
            foreach ((array)json_decode($workflow->approve_list) as $key => $val) {
                if ($key == $post->reviewer_id) {
                    break;
                }
                $approved ++;
            }
        }
        return [
            'count' => $count,
            'user' => $user ? $user->last_name.' '.$user->first_name : '',
            'approved' => $post->count_approve,
            'statusPost' => $post->status
        ];
    }
    public function updatePublicPostSetTime(){
        $time = date(now());
        db::table('rainlab_blog_posts')
            ->where('approved',1)
            ->where('published_at' ,'<=',$time)
            ->where('published', 0)
            ->where('action' , 4)
            ->where('status' , 6)
            ->update(['published'=> 1 ,'status'=> 5]);
    }
}