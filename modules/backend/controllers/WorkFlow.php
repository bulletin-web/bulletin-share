<?php namespace Backend\Controllers;

use BackendMenu;
use BackendAuth;
use Backend\Classes\Controller;
use System\Classes\SettingsManager;

/**
 * Backend user groups controller
 *
 * @package october\backend
 * @author Alexey Bobkov, Samuel Georges
 *
 */
class WorkFlow extends Controller
{
    public $listUser;

    public $listCurentUser;

    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class
    ];

    public $formConfig = 'config_form.yaml';

    public $listConfig = 'config_list.yaml';

    /**
     * @var array Permissions required to view this page.
     */
    public $requiredPermissions = ['backend.workflow_setting'];

    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('October.System', 'system', 'users');
        SettingsManager::setContext('October.System', 'workflow');
    }

    public function create()
    {
        $this->listUser = app('backend.approve')->getListUser();
        return $this->asExtension('FormController')->create();
    }

    public function update($recordId = null)
    {
        $this->listCurentUser = app('backend.approve')->getCurrentUserList($recordId);
        $this->listUser = app('backend.approve')->getListUserOfRule($recordId);
        return $this->asExtension('FormController')->update($recordId);
    }
}
