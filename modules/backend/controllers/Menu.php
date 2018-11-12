<?php
/**
 * Created by PhpStorm.
 * User: ken
 * Date: 30/01/2018
 * Time: 11:07
 */

namespace Backend\Controllers;


use Backend\Classes\Controller;
use Backend\Facades\BackendMenu;
use System\Classes\SettingsManager;

class Menu extends Controller
{
    public $listCategory;
    public $listTag;
    public $listPage;
    public $listMenu;
    /**
     * @var array Extensions implemented by this controller.
     */
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class
    ];

    /**
     * @var string FormController` configuration.
     */
    public $formConfig = 'config_form.yaml';

    /**
     * @var string ListController` configuration.
     */
    public $listConfig = 'config_list.yaml';

    /**
     * @var array Permissions required to view this page.
     */
    public $requiredPermissions = ['backend.blog.menu_setting'];

    /**
     * Menu constructor.
     */
    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('October.System', 'system', 'users');
        SettingsManager::setContext('October.System', 'backend_menu');
    }

    public function create()
    {
        $this->listCategory = app('content.menu')->getListCategory();
        $this->listTag = app('content.menu')->getListTag();
        $this->listPage = app('content.menu')->getListPage();
        return $this->asExtension('FormController')->create();
    }

    public function update($recordId = null)
    {
        $this->listCategory = app('content.menu')->getCurrentListCategory($recordId);
        $this->listTag = app('content.menu')->getCurrentListTag($recordId);
        $this->listPage = app('content.menu')->getCurrentListPage($recordId);
        $this->listMenu = app('content.menu')->getListMenu($recordId);
        return $this->asExtension('FormController')->update($recordId);
    }
}