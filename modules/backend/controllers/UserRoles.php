<?php namespace Backend\Controllers;

use Backend\Models\UserRole;
use View;
use Response;
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
class UserRoles extends Controller
{
    public $superRole;
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
    public $requiredPermissions = ['backend.role.*'];

    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('October.System', 'system', 'users');
        SettingsManager::setContext('October.System', 'user_roles');

        /*
         * Only super users can access
         */
//        $this->bindEvent('page.beforeDisplay', function() {
//            if (!$this->user->isSuperUser()) {
//                return Response::make(View::make('backend::access_denied'), 403);
//            }
//        });
    }

    public function update($recordId, $context = null)
    {
        $this->superRole = UserRole::find($recordId)->is_system;
        return $this->asExtension('FormController')->update($recordId, $context);
    }

    /**
     * Add available permission fields to the Role form.
     */
    public function formExtendFields($form)
    {
        /*
         * Add permissions tab
         */
        $form->addTabFields($this->generatePermissionsField());
    }

    /**
     * Adds the permissions editor widget to the form.
     * @return array
     */
    protected function generatePermissionsField()
    {
        return [
            'permissions' => [
                'tab' => 'backend::lang.user.permissions',
                'type' => 'Backend\FormWidgets\PermissionEditor',
                'mode' => 'checkbox'
            ]
        ];
    }
}
