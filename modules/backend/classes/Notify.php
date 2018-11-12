<?php namespace Backend\Classes;
use RainLab\Blog\Models\Post;
use Backend\Models\User;
use BackendAuth;
use Backend;
use Db;

/**
 * Class Notify
 * @package Backend\Classes
 */

class Notify
{
    public function getListPostApprove($loginId)
    {
        $data = [];
        $posts = Post::where('reviewer_id', $loginId)
            ->where('status', 2)
            ->where('reviewer_read', 0)
            ->get();

        $sumRecord = $posts->count();
        $data['sum'] =  $sumRecord;

        $date = date('Y') . '年' . date('m') . '月' . date('d') . '日';
        if ($sumRecord > 0) {
            $data['type'] = 'request-approve';
            foreach ($posts as $key => $post) {
                $data['posts'][$key] = [$post->id, '[承認要求] ' . $post->title, $date];
            }
        }

        return $data;
    }

    public function getListPostReject($loginId)
    {
        $data = [];
        $posts = Post::where('user_id', $loginId)
            ->where('status', 7)
            ->where('post_reject', 1)
            ->where('owner_read_notify', 0)
            ->get();

        $sumRecord = $posts->count();
        $data['sum'] =  $sumRecord;

        $date = date('Y') . '年' . date('m') . '月' . date('d') . '日';
        if ($sumRecord > 0) {
            $data['type'] = 'reject-post';
            foreach ($posts as $key => $post) {
                $data['posts'][$key] = [$post->id, '[拒絶する] ' . $post->title, $date];
            }
        }

        return $data;

    }

    public function getListNotify($loginId)
    {
        $data = [];
        $index = 0;
        $posts = [];

        $listRequestApprove = Post::orderBy('updated_at')
            ->where('reviewer_id', $loginId)
            ->whereIn('status', [2,3,4])
            ->get();
        $sumRequestApprove = $listRequestApprove->count();
        if ($sumRequestApprove > 0) {
            $urlPost = Backend::url("backend/post/review");
            $urlUprule = Backend::url("rainlab/blog/posts/update/");
            foreach ($listRequestApprove as $key => $post) {
                $index += $key;
                if($post->user_id == $post->reviewer_id && $post->approved == 1 && $post->count_approve != 0){
                    $posts[$index] = [$urlUprule . '/' . $post->id.'/#secondarytab-3', '[承認済み] ' . $post->title, date_format($post->updated_at, 'Y年m月d日'), $post->reviewer_read, strtotime($post->updated_at)];
                }else{

                    $posts[$index] = [$urlPost . '/' . $post->id, '[承認要求] ' . $post->title, date_format($post->updated_at, 'Y年m月d日'), $post->reviewer_read, strtotime($post->updated_at)];
                }

            }
        }

        $listPostReject = Post::orderBy('updated_at')
            ->where('user_id', $loginId)
            ->where('status', 7)
            ->where('post_reject', 1)
            ->get();
        $sumPostReject = $listPostReject->count();
        if ($sumPostReject > 0) {
            $urlPostReject = Backend::url("backend/post/reject");
            $index++;
            foreach ($listPostReject as $key => $post) {
                $index += $key;
                $posts[$index] = [$urlPostReject . '/' . $post->id, '[拒絶する] ' . $post->title, date_format($post->updated_at, 'Y年m月d日'), $post->owner_read_notify, strtotime($post->updated_at)];
            }
        }

        array_multisort(array_column($posts, 3),SORT_ASC,
                        array_column($posts, 4),SORT_DESC,
                        $posts);

        $data['posts'] = $posts;
        $data['sum'] =  $sumRequestApprove + $sumPostReject;
        $data['sumNotRead'] = $this->getListNotifyNoRead($loginId);

        return $data;
    }

    protected function getListNotifyNoRead($loginId)
    {
        $listRequestApprove = Post::where('reviewer_id', $loginId)
            ->whereIn('status', [2,3])
            ->where('reviewer_read', 0)
            ->get();
        $listRequestPublic = Post::where('reviewer_id', $loginId)
            ->where('status',4)
            ->where('publish_read_post', 0)
            ->get();

        $listPostReject = Post::where('user_id', $loginId)
            ->where('status', 7)
            ->where('post_reject', 1)
            ->where('owner_read_notify', 0)
            ->get();

        return $listRequestApprove->count() + $listPostReject->count() + $listRequestPublic->count();
    }

    public function resetNotifyRequestApprove()
    {
        $posts = Post::where('status', 2)
            ->where('reviewer_read', 1)
            ->where('post_reject', 0)
            ->get();
        $listIdPost = [];
        if ($posts) {
            foreach ($posts as $post) {
                array_push($listIdPost, $post->id);
            }
            db::table('rainlab_blog_posts')
            ->whereIn('id', $listIdPost)
            ->update(['reviewer_read' => 0]);
        }
    }

    public function resetNotifyRejectPost()
    {
        $posts = Post::where('status', 7)
            ->where('post_reject', 1)
            ->where('owner_read_notify', 1)
            ->get();
        $listIdPost = [];
        if ($posts) {
            foreach ($posts as $post) {
                array_push($listIdPost, $post->id);
            }
        db::table('rainlab_blog_posts')
            ->whereIn('id', $listIdPost)
            ->update(['owner_read_notify' => 0]);
        }
    }
}
