<?php namespace Backend\Classes;
use Backend\Facades\BackendAuth;
use RainLab\Blog\Models\Post;
use Validator;
use Db;

/**
 * Class PostProvider
 * @package Backend\Classes
 */

class PostProvider
{
    public $rules = [
        'reason' => 'required',
    ];

    public $messages = [
        'reason.required' => '却下理由を入力してください。',
    ];

    public function getPost($postId)
    {
        return Post::where('id', $postId)->first();
    }

    protected function validPostId($postId)
    {
        if ((int)$postId > 0) {
            if (Post::where('id', $postId)->exists())
            return true;
        }

        return false;

    }

    public function validReviewer($postId)
    {
        if ($this->validPostId($postId)) {
           if (Post::where('id', $postId)->where('reviewer_id', BackendAuth::getUser()->id)->exists()) {
               return true;
           }
        }
        return false;
    }

    public function validOwner($postId)
    {
        if ($this->validPostId($postId)) {
            if (Post::where('id', $postId)->where('user_id', BackendAuth::getUser()->id)->exists()) {
                return true;
            }
        }

        return false;
    }

    public function approvePost($postId)
    {
        $post = $this->getPost($postId);
        $dataupdate = [];
        $listUserApprove = app('backend.approve')
            ->getListUserApproveOfPostWithRuleId($post->workflow_id);
        if ($post->count_approve == count($listUserApprove) - 1) {
            $dataupdate['reviewer_id'] = $post->user_id;
            $dataupdate['reviewer_read'] = false;
            $dataupdate['count_approve'] = $post->count_approve +1;
            $dataupdate['approved'] = 1;
            $dataupdate['status'] = 4;
        } else {
            foreach ($listUserApprove as $key => $user) {
                if ($user->id == BackendAuth::getUser()->id) {
                    $dataupdate['count_approve'] = $post->count_approve +1;
                    $dataupdate['reviewer_id'] = $listUserApprove[$key + 1]->id;
                    $dataupdate['reviewer_read'] = false;
                    $dataupdate['status'] = 3;
                }
            }
        }
        $save =  db::table('rainlab_blog_posts')
        ->where('id', $postId)
        ->update($dataupdate);
        if ($save) {
            return true;
        }

        return false;
    }

    public function readPost($postId)
    {
        return db::table('rainlab_blog_posts')
            ->where('id', $postId)
            ->update(['reviewer_read' => true]);
    }
    public function readPublic($postId){
        return db::table('rainlab_blog_posts')
            ->where('id', $postId)
            ->where('status',4)
            ->where('reviewer_id',BackendAuth::getUser()->id)
            ->where('user_id',BackendAuth::getUser()->id)
            ->where('approved', 1)
            ->update(['publish_read_post' => 1]);
    }
    public function isUprule($reviewer_read){
        if($reviewer_read){
            return true;
        }
        return false;
    }

    public function ownerReadPost($postId)
    {
        db::table('rainlab_blog_posts')
            ->where('id', $postId)
            ->update(['owner_read_notify' => true]);
    }

    public function validation($data)
    {
        return Validator::make($data, $this->rules, $this->messages);
    }

    public function rejectPost($data)
    {
        $post = Post::where('id', $data['postId'])->where('reviewer_id', BackendAuth::getUser()->id)->first();

        if ($post) {
            $save = db::table('rainlab_blog_posts')
                ->where('id', $data['postId'])
                ->update([
                    'reviewer_comment' => $data['reason'],
                    'post_reject' => true,
                    'status' => 7,
                    'count_approve' => false
                    ]);
            if ($save) {
                return true;
            }
        }

        return false;
    }
}
