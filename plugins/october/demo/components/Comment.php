<?php namespace October\Demo\Components;

use Backend\Models\CommentBlackList;
use Cms\Classes\ComponentBase;
use Validator;

class Comment extends ComponentBase
{
//    public $test;

    public $data;

    public $rules = [
        'name' => 'required|between:2,64',
        'email' => 'required|email',
        'content' => 'required'
    ];

    public $messages = [
        'name.required' => '名前は、必ず指定してください。',
        'name.between' => '名前は、2文字から64文字にしてください。',
        'email.required' => '電子メールは、必ず指定してください。',
        'content.required' => '内容は、必ず指定してください。'
    ];

    public function replaceTextBlackList($string)
    {
        $blackList = $this->getCommentBlackList();
        foreach ($blackList as $row)
        {
            $string = str_replace(trim($row['phrase']), '***', $string);
        }

        return $string;
    }

    public function getCommentBlackList()
    {
        return CommentBlackList::all();
    }

    public function componentDetails()
    {
        return [
            'name' => 'Comment',
            'description' => 'Comment'
        ];
    }

    public function store()
    {
        if (post())
        {
            $validator = $this->validator(post());
            if ($validator->fails())
            {
                $this->data = [
                    'error' => $validator->messages(),
                    'post' => post()
                ];
            } else {
                $this->insertCommentToDatabase(post());
            }
        }
    }

    public function insertCommentToDatabase($post)
    {
        \RainLab\Blog\Models\Comment::create([
            'name' => $post['name'],
            'email' => $post['email'],
            'content' => $post['content'],
            'post_id' => $post['post_id'],
        ]);
        $this->data = [
            'success' => 'Success',
            'post' => post()
        ];
    }


    public function validator($post)
    {
        return Validator::make($post, $this->rules, $this->messages);
    }
}