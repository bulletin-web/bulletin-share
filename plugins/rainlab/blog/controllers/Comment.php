<?php namespace RainLab\Blog\Controllers;


use Backend\Classes\Controller;
use Backend\Facades\BackendMenu;
use System\Classes\SettingsManager;

class Comment extends Controller
{
    public $data;

    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class
    ];

    public $formConfig = 'config_form.yaml';

    public $listConfig = 'config_list.yaml';

    public $requiredPermissions = ['backend.comment.*'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('October.System', 'system', 'users');
        SettingsManager::setContext('October.System', 'comment_manager');
    }

    public function update($recordId, $context = null)
    {
        $this->data = $this->getPostTitlePostUrl($recordId);
        return $this->asExtension('FormController')->update($recordId, $context);
    }

    public function getPostTitlePostUrl($id)
    {
        $comment = \RainLab\Blog\Models\Comment::find($id);
        if ($comment)
        {
            return [
                'title' => $comment->posts->title,
                'url'   => $comment->posts->slug,
                'name'  => $comment->name,
                'email' => $comment->email
            ];
        }
    }
}