<?php namespace Backend\Controllers;

use Backend;
use BackendMenu;
use BackendAuth;
use Backend\Models\UserGroup;
use Backend\Classes\Controller;
use System\Classes\SettingsManager;
use Backend\Models\User;

/**
 * Backend user controller
 *
 * @package october\backend
 * @author Alexey Bobkov, Samuel Georges
 *
 */
class Users extends Controller
{
    public $systemUser;
    /**
     * @var array Extensions implemented by this controller.
     */
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
        \Backend\Behaviors\RelationController::class
    ];

    /**
     * @var array `FormController` configuration.
     */
    public $formConfig = 'config_form.yaml';

    /**
     * @var array `ListController` configuration.
     */
    public $listConfig = 'config_list.yaml';

    public $relationConfig = 'config_relation.yaml';

    /**
     * @var array Permissions required to view this page.
     */
    public $requiredPermissions = ['backend.user.*'];

    /**
     * @var string HTML body tag class
     */
    public $bodyClass = 'compact-container';

    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();

        if ($this->action == 'myaccount') {
            $this->requiredPermissions = null;
        }

        BackendMenu::setContext('October.System', 'system', 'users');
        SettingsManager::setContext('October.System', 'users');
    }

    /**
     * Update controller
     */
    public function update($recordId, $context = null)
    {
        // Users cannot edit themselves, only use My Settings
        if ($context != 'myaccount' && $recordId == $this->user->id) {
            return Backend::redirect('backend/users/myaccount');
        }
        $this->systemUser = User::find($recordId)->is_superuser;
        return $this->asExtension('FormController')->update($recordId, $context);
    }

    /**
     * My Settings controller
     */
    public function myaccount()
    {
        SettingsManager::setContext('October.Backend', 'myaccount');

        $this->pageTitle = 'backend::lang.myaccount.menu_label';
        return $this->update($this->user->id, 'myaccount');
    }

    /**
     * Proxy update onSave event
     */
    public function myaccount_onSave()
    {
        $result = $this->asExtension('FormController')->update_onSave($this->user->id, 'myaccount');

        /*
         * If the password or login name has been updated, reauthenticate the user
         */
        $loginChanged = $this->user->login != post('User[login]');
        $passwordChanged = strlen(post('User[password]'));
        if ($loginChanged || $passwordChanged) {
            BackendAuth::login($this->user->reload(), true);
        }

        return $result;
    }

    /**
     * Add available permission fields to the User form.
     * Mark default groups as checked for new Users.
     */
    public function formExtendFields($form)
    {
        if ($form->getContext() == 'myaccount') {
            return;
        }

//        if (!$this->user->isSuperUser()) {
//            $form->removeField('is_superuser');
//            $form->removeField('role');
//        }

        /*
         * Add permissions tab
         */
//        $form->addTabFields($this->generatePermissionsField());

        /*
         * Mark default groups
         */
        if (!$form->model->exists) {
            $defaultGroupIds = UserGroup::where('is_new_user_default', true)->lists('id');

            $groupField = $form->getField('groups');
            $groupField->value = $defaultGroupIds;
        }
    }

    /**
     * Adds the permissions editor widget to the form.
     * @return array
     */
//    protected function generatePermissionsField()
//    {
//        return [
//            'permissions' => [
//                'tab' => 'backend::lang.user.permissions',
//                'type' => 'Backend\FormWidgets\PermissionEditor',
//                'trigger' => [
//                    'action' => 'disable',
//                    'field' => 'is_superuser',
//                    'condition' => 'checked'
//                ]
//            ]
//        ];
//    }
}
