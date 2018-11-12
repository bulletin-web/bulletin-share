<?php namespace RainLab\Blog\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use RainLab\Blog\Models\Category;
use Flash;
use System\Classes\SettingsManager;

class Categories extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.ReorderController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public $requiredPermissions = ['backend.blog.edit_category'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('October.System', 'system', 'users');
        SettingsManager::setContext('October.System', 'blog_category');
    }

    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $categoryId) {
                if ((!$category = Category::find($categoryId)))
                    continue;

                $category->delete();
            }

            Flash::success('指定のカテゴリが削除されました。');
        }

        return $this->listRefresh();
    }
}