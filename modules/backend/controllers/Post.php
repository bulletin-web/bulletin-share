<?php namespace Backend\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Illuminate\Support\Facades\Redirect;
use Backend;

class Post extends Controller
{
    public $data;

    public function review($postId = null)
    {
        if (app('backend.post')->validReviewer($postId)) {
            app('backend.post')->readPost($postId);
            $this->data = app('backend.post')->getPost($postId);
        } else {
            return Redirect::to('backend/rainlab/blog/posts');
        }
    }

    public function approve($postId = null)
    {
        if (app('backend.post')->validReviewer($postId)) {
            if (app('backend.post')->approvePost($postId)) {
                return Redirect::to('backend/rainlab/blog/posts')
                    ->withSuccess(trans('rainlab.blog::lang.post.publish_post'));
            }
        }

        return Redirect::back();
    }

    public function rejectPost()
    {
        if(post()) {
            $validator = app('backend.post')->validation(post());
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator);
            }

            if (app('backend.post')->rejectPost(post()))
            {
                return Redirect::back()->withSuccess(trans('rainlab.blog::lang.post.reject_post'));
            }
        }

        return Redirect::back();
    }

    public function reject($postId = null)
    {
        if (app('backend.post')->validOwner($postId)) {
            app('backend.post')->ownerReadPost($postId);
            $this->data = app('backend.post')->getPost($postId);
        } else {
            return Redirect::back();
        }
    }
}
