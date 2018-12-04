<?php namespace October\Demo\Components;

use Backend\Models\CommentBlackList;
use Cms\Classes\ComponentBase;
use Rainlab\Blog\Models\Comments;
use Validator;

class Comment extends ComponentBase
{

    public $data;

    public $rules = [
        'ip-1' => 'required|between:2,64',
        'ip-2' => 'required|email',
        'ip-3' => 'required',
    ];

    public $messages = [
        'ip-1.required' => '名前は、必ず指定してください。',
        'ip-1.between' => '名前は、2文字から64文字にしてください。',
        'ip-2.required' => '電子メールは、必ず指定してください。',
        'ip-3.required' => '性別 必ず指定してください。'
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

    public function getContentOfOthersItem($idComment)
    {
        $comment = \RainLab\Blog\Models\Comment::where('id', $idComment)->first();
        $othersItem = json_decode($comment->others_item);
        $contentItems = [];
        foreach ($othersItem as $item) {
            $contentItems[] = $item;
        }

        return $contentItems;
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
        $this->removeRuleIfNotActive(post());
        $this->addRulesIfRequired();
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
        $othersInput = $this->getOthersInput($post);
        if (count($othersInput) > 0) {
            \RainLab\Blog\Models\Comment::create([
                'name' => isset($post['ip-1']) ? $post['ip-1'] : null,
                'email' => isset($post['ip-2']) ? $post['ip-2'] : null,
                'age' => isset($post['ip-4']) ? $post['ip-4'] : null,
                'sex' => isset($post['ip-3']) ? $post['ip-3'] : null,
                'post_id' => $post['post_id'],
                'others_item' => json_encode($othersInput)
            ]);
        } else {
            \RainLab\Blog\Models\Comment::create([
                'name' => isset($post['ip-1']) ? $post['ip-1'] : null,
                'email' => isset($post['ip-2']) ? $post['ip-2'] : null,
                'age' => isset($post['ip-4']) ? $post['ip-4'] : null,
                'sex' => isset($post['ip-3']) ? $post['ip-3'] : null,
                'post_id' => $post['post_id'],
            ]);
        }
        $this->data = [
            'success' => 'Success',
            'post' => post()
        ];
    }


    public function validator($post)
    {
        return Validator::make($post, $this->rules, $this->messages);
    }

    public function loadSettingsComments()
    {
        $settingsComments = Comments::where('active', 1)->where('order', '>', 0)->orderBy('order', 'asc')->get();
        return $settingsComments;
    }

    public function getItemForPullDownOrRadio($settingsComment)
    {
        $listItem = explode("\r\n", $settingsComment->content);
        return $listItem;
    }

    public function addRulesIfRequired()
    {
        $settingsComments = Comments::where('require', 1)->where('active', 1)->where('id', '>', 4)->get();
        if (count($settingsComments) > 0) {
            foreach ($settingsComments as $settingsComment) {
                $keyRule = 'ip-' . $settingsComment->id;
                $this->rules[$keyRule] = 'required';
                $keyMes = $keyRule . '.required';
                $this->messages[$keyMes] = $settingsComment->name . '必ず指定してください。';
            }
        }
    }

    public function getOthersInput($post)
    {
        $othersPost = [];

        $settingsComments = Comments::where('require', 1)->where('id', '>', 4)->get();
        if (count($settingsComments) > 0) {
            foreach ($settingsComments as $settingsComment) {
                if (array_key_exists('ip-'.$settingsComment->id, $post)) {
                    $othersPost['ip-'.$settingsComment->id] = $post['ip-'.$settingsComment->id];
                }
            }
        }

        return $othersPost;
    }

    public function removeRuleIfNotActive($post)
    {
        if (!isset($post['ip-1'])) {
            unset($this->rules['ip-1']);
        }

        if (!isset($post['ip-2'])) {
            unset($this->rules['ip-2']);
        }

        if (!isset($post['ip-3'])) {
            unset($this->rules['ip-3']);
        }
    }
}
