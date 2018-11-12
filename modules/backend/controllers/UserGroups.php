<?php namespace Backend\Controllers;

use BackendMenu;
use BackendAuth;
use Backend;
use Response;
use Backend\Classes\Controller;
use System\Classes\SettingsManager;
use Backend\Classes\UserGroupRepository;

/**
 * Backend user groups controller
 *
 * @package october\backend
 * @author Alexey Bobkov, Samuel Georges
 *
 */
class UserGroups extends Controller
{
    /**
     * @var array Extensions implemented by this controller.
     */
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class
    ];

    /**
     * @var array `FormController` configuration.
     */
    public $formConfig = 'config_form.yaml';

    /**
     * @var array `ListController` configuration.
     */
    public $listConfig = 'config_list.yaml';

    /**
     * @var array Permissions required to view this page.
     */
    public $requiredPermissions = ['backend.group.*'];

    public $data;
    protected $repository;

    /**
     * Constructor.
     *
     * @param UserGroupRepository $repository
     */
    public function __construct(UserGroupRepository $repository)
    {
        parent::__construct();

        BackendMenu::setContext('October.System', 'system', 'users');
        SettingsManager::setContext('October.System', 'user_groups');

        $this->repository = $repository;
    }

    public function priority()
    {
        $this->addCss('/modules/backend/assets/vendor/jquery-ui-1-12-1/jquery-ui.css');
        $this->addJs('/modules/backend/assets/vendor/jquery-ui-1-12-1/jquery-ui-sortable.js');
        $this->data = $this->repository->getAllSortByDisplayOrder();
    }

    public function savePrioritySetting()
    {
        if (post('token')) {
            $data = json_decode(post('data'));
            $this->repository->saveDisplayOrder($data);
            return Response::json('success');
        }
    }

    public function formBeforeCreate($model)
    {
        $maxOrder = (int)$model->max('display_order');
        $model->display_order = $maxOrder + 1;
    }
}
