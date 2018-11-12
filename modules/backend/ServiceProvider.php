<?php namespace Backend;

use App;
use Backend;
use BackendMenu;
use BackendAuth;
use Backend\Classes\WidgetManager;
use System\Classes\MailManager;
use System\Classes\CombineAssets;
use System\Classes\SettingsManager;
use October\Rain\Support\ModuleServiceProvider;
use Backend\Classes\BackendBackup;

class ServiceProvider extends ModuleServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        parent::register('backend');

        $this->registerSingletons();
        $this->registerMailer();
        $this->registerAssetBundles();

        /*
         * Backend specific
         */
        if (App::runningInBackend()) {
            $this->registerBackendNavigation();
            $this->registerBackendReportWidgets();
            $this->registerBackendWidgets();
            $this->registerBackendPermissions();
            $this->registerBackendSettings();
        }
    }

    /**
     * Register singletons
     */
    protected function registerSingletons()
    {
        App::singleton('backend.backup', function () {
            return new BackendBackup();
        });

        App::singleton('backend.notify', function () {
            return new Backend\Classes\Notify();
        });

        App::singleton('backend.post', function () {
            return new Backend\Classes\PostProvider();
        });
    }

    /**
     * Bootstrap the module events.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot('backend');
    }

    /**
     * Register mail templates
     */
    protected function registerMailer()
    {
        MailManager::instance()->registerCallback(function ($manager) {
            $manager->registerMailTemplates([
                'backend::mail.invite',
                'backend::mail.restore',
            ]);
        });
    }

    /**
     * Register asset bundles
     */
    protected function registerAssetBundles()
    {
        CombineAssets::registerCallback(function ($combiner) {
            $combiner->registerBundle('~/modules/backend/assets/less/october.less');
            $combiner->registerBundle('~/modules/backend/assets/js/october.js');
            $combiner->registerBundle('~/modules/backend/widgets/table/assets/js/build.js');
            $combiner->registerBundle('~/modules/backend/formwidgets/codeeditor/assets/less/codeeditor.less');
            $combiner->registerBundle('~/modules/backend/formwidgets/codeeditor/assets/js/build.js');
            $combiner->registerBundle('~/modules/backend/formwidgets/fileupload/assets/less/fileupload.less');

            /*
             * Rich Editor is protected by DRM
             */
            if (file_exists(base_path('modules/backend/formwidgets/richeditor/assets/vendor/froala_drm'))) {
                $combiner->registerBundle('~/modules/backend/formwidgets/richeditor/assets/less/richeditor.less');
                $combiner->registerBundle('~/modules/backend/formwidgets/richeditor/assets/js/build.js');
            }
        });
    }

    /*
     * Register navigation
     */
    protected function registerBackendNavigation()
    {
        BackendMenu::registerCallback(function ($manager) {
            $manager->registerMenuItems('October.Backend', [
//                'dashboard' => [
//                    'label'       => 'backend::lang.dashboard.menu_label',
//                    'icon'        => 'icon-dashboard',
//                    'iconSvg'     => 'modules/backend/assets/images/dashboard-icon.svg',
//                    'url'         => Backend::url('backend'),
//                    'permissions' => ['backend.access_dashboard'],
//                    'order'       => 10
//                ]
            ]);
        });
    }

    /*
     * Register report widgets
     */
    protected function registerBackendReportWidgets()
    {
        WidgetManager::instance()->registerReportWidgets(function ($manager) {
            $manager->registerReportWidget(\Backend\ReportWidgets\Welcome::class, [
                'label'   => 'backend::lang.dashboard.welcome.widget_title_default',
                'context' => 'dashboard'
            ]);
        });
    }

    /*
     * Register permissions
     */
    protected function registerBackendPermissions()
    {
        BackendAuth::registerCallback(function ($manager) {
            $manager->registerPermissions('October.Backend', [

                // Register Permissions Site Table
                'backend.site_infos' => [
                    'label' => 'system::lang.permissions.manage_site.basic_site_setting',
                    'tab'   => 'system::lang.permissions.tab.manage_site',
                    'order' => 10
                ],
                'backend.site_display_setting' => [
                    'label' => 'system::lang.permissions.manage_site.display_site_setting',
                    'tab'   => 'system::lang.permissions.tab.manage_site',
                    'order' => 20
                ],
                'backend.access_backup' => [
                    'label' => 'system::lang.permissions.manage_site.site_backup',
                    'tab'   => 'system::lang.permissions.tab.manage_site',
                    'order' => 30
                ],

                // Register Permissions User Table
                'backend.user.add_new_user' => [
                    'label' => 'system::lang.permissions.manage_user.add_new_user',
                    'tab'   => 'system::lang.permissions.tab.manage_user',
                    'order' => 40
                ],
                'backend.user.edit_user' => [
                    'label' => 'system::lang.permissions.manage_user.edit_user',
                    'tab'   => 'system::lang.permissions.tab.manage_user',
                    'order' => 50
                ],
                'backend.user.delete_user' => [
                    'label' => 'system::lang.permissions.manage_user.delete_user',
                    'tab'   => 'system::lang.permissions.tab.manage_user',
                    'order' => 60
                ],
                'backend.group.add_new_group' => [
                    'label' => 'system::lang.permissions.manage_user.add_new_group',
                    'tab'   => 'system::lang.permissions.tab.manage_user',
                    'order' => 70
                ],
                'backend.group.edit_group' => [
                    'label' => 'system::lang.permissions.manage_user.edit_group',
                    'tab'   => 'system::lang.permissions.tab.manage_user',
                    'order' => 80
                ],
                'backend.group.delete_group' => [
                    'label' => 'system::lang.permissions.manage_user.delete_group',
                    'tab'   => 'system::lang.permissions.tab.manage_user',
                    'order' => 90
                ],
                'backend.add_many_users' => [
                    'label' => 'system::lang.permissions.manage_user.add_many_users',
                    'tab'   => 'system::lang.permissions.tab.manage_user',
                    'order' => 100
                ],
                'backend.add_many_groups' => [
                    'label' => 'system::lang.permissions.manage_user.add_many_groups',
                    'tab'   => 'system::lang.permissions.tab.manage_user',
                    'order' => 110
                ],

                // Register Permissions Workplace Table
                'backend.role.add_new_role' => [
                    'label' => 'system::lang.permissions.manage_workflow.add_new_role',
                    'tab'   => 'system::lang.permissions.tab.manage_workflow',
                    'order' => 50
                ],
                'backend.role.edit_role' => [
                    'label' => 'system::lang.permissions.manage_workflow.edit_role',
                    'tab'   => 'system::lang.permissions.tab.manage_workflow',
                    'order' => 60
                ],
                'backend.role.delete_role' => [
                    'label' => 'system::lang.permissions.manage_workflow.delete_role',
                    'tab'   => 'system::lang.permissions.tab.manage_workflow',
                    'order' => 70
                ],
                'backend.workflow_setting' => [
                    'label' => 'system::lang.permissions.manage_workflow.workflow_setting',
                    'tab'   => 'system::lang.permissions.tab.manage_workflow',
                    'order' => 80
                ],

                // Register Permissions Content Table
                'backend.theme.register_theme' => [
                    'label' => 'system::lang.permissions.manage_content.register_theme',
                    'tab'   => 'system::lang.permissions.tab.manage_content',
                    'order' => 60
                ],
                'backend.theme.theme_setting' => [
                    'label' => 'system::lang.permissions.manage_content.theme_setting',
                    'tab'   => 'system::lang.permissions.tab.manage_content',
                    'order' => 70
                ],
                'backend.theme.remove_theme' => [
                    'label' => 'system::lang.permissions.manage_content.remove_theme',
                    'tab'   => 'system::lang.permissions.tab.manage_content',
                    'order' => 70
                ],
                'backend.blog.add_new_post' => [
                    'label' => 'system::lang.permissions.manage_content.add_new_post',
                    'tab'   => 'system::lang.permissions.tab.manage_content',
                    'order' => 80
                ],
                'backend.blog.edit_post_of_mine' => [
                    'label' => 'system::lang.permissions.manage_content.edit_post_of_mine',
                    'tab'   => 'system::lang.permissions.tab.manage_content',
                    'order' => 90
                ],
                'backend.blog.others.edit_post_others' => [
                    'label' => 'system::lang.permissions.manage_content.edit_post_others',
                    'tab'   => 'system::lang.permissions.tab.manage_content',
                    'order' => 100
                ],
                'backend.blog.publish_post' => [
                    'label' => 'system::lang.permissions.manage_content.publish_post',
                    'tab'   => 'system::lang.permissions.tab.manage_content',
                    'order' => 110
                ],
                'backend.bog.post_accept_fixed_page' => [
                    'label' => 'system::lang.permissions.manage_content.post_accept_fixed_page',
                    'tab'   => 'system::lang.permissions.tab.manage_content',
                    'order' => 120
                ],
                'backend.blog.delete_post_of_mine' => [
                    'label' => 'system::lang.permissions.manage_content.delete_post_of_mine',
                    'tab'   => 'system::lang.permissions.tab.manage_content',
                    'order' => 130
                ],
                'backend.blog.others.delete_post_others' => [
                    'label' => 'system::lang.permissions.manage_content.delete_post_others',
                    'tab'   => 'system::lang.permissions.tab.manage_content',
                    'order' => 140
                ],
                'backend.blog.add_new_fixed_page' => [
                    'label' => 'system::lang.permissions.manage_content.add_new_fixed_page',
                    'tab'   => 'system::lang.permissions.tab.manage_content',
                    'order' => 150
                ],
                'backend.blog.edit_fixed_page_of_mine' => [
                    'label' => 'system::lang.permissions.manage_content.edit_fixed_page_of_mine',
                    'tab'   => 'system::lang.permissions.tab.manage_content',
                    'order' => 160
                ],
                'backend.blog.edit_fixed_page_others' => [
                    'label' => 'system::lang.permissions.manage_content.edit_fixed_page_others',
                    'tab'   => 'system::lang.permissions.tab.manage_content',
                    'order' => 170
                ],
                'backend.blog.delete_fixed_page_of_mine' => [
                    'label' => 'system::lang.permissions.manage_content.delete_fixed_page_of_mine',
                    'tab'   => 'system::lang.permissions.tab.manage_content',
                    'order' => 180
                ],
                'backend.blog.delete_fixed_page_others' => [
                    'label' => 'system::lang.permissions.manage_content.delete_fixed_page_others',
                    'tab'   => 'system::lang.permissions.tab.manage_content',
                    'order' => 190
                ],
                'backend.blog.approve_fixed_page' => [
                    'label' => 'system::lang.permissions.manage_content.publish_fixed_page',
                    'tab'   => 'system::lang.permissions.tab.manage_content',
                    'order' => 200
                ],
                'backend.blog.menu_setting' => [
                    'label' => 'system::lang.permissions.manage_content.menu_setting',
                    'tab'   => 'system::lang.permissions.tab.manage_content',
                    'order' => 210
                ],
                'backend.blog.edit_category' => [
                    'label' => 'system::lang.permissions.manage_content.edit_category',
                    'tab'   => 'system::lang.permissions.tab.manage_content',
                    'order' => 220
                ],
                'backend.blog.edit_tag' => [
                    'label' => 'system::lang.permissions.manage_content.edit_tag',
                    'tab'   => 'system::lang.permissions.tab.manage_content',
                    'order' => 230
                ],'backend.blog.approve_post' => [
                    'label' => 'system::lang.permissions.manage_content.approve_post',
                    'tab'   => 'system::lang.permissions.tab.manage_content',
                    'order' => 240
                ],
                'backend.blog.public_stop' => [
                    'label' => 'system::lang.permissions.manage_content.approve_post_stop',
                    'tab'   => 'system::lang.permissions.tab.manage_content',
                    'order' => 250
                ],

                // Register Permissions Comment Table
                'backend.comment.approve_comment' => [
                    'label' => 'system::lang.permissions.manage_comment.approve_comment',
                    'tab' => 'system::lang.permissions.tab.manage_comment',
                    'order' => 70
                ],
                'backend.comment.remove_comment' => [
                    'label' => 'system::lang.permissions.manage_comment.remove_comment',
                    'tab' => 'system::lang.permissions.tab.manage_comment',
                    'order' => 80
                ],
                'backend.comment.access_blacklist' => [
                    'label' => 'system::lang.permissions.manage_comment.blacklist_comment',
                    'tab' => 'system::lang.permissions.tab.manage_comment',
                    'order' => 90
                ],

                // Register Permissions Plugin Table
                'backend.plugin.install_plugin' =>[
                    'label' => 'system::lang.permissions.manage_plugin.install_plugin',
                    'tab' => 'system::lang.permissions.tab.manage_plugin',
                    'order' => 90
                ],
                'backend.plugin.active_plugin' =>[
                    'label' => 'system::lang.permissions.manage_plugin.active_plugin',
                    'tab' => 'system::lang.permissions.tab.manage_plugin',
                    'order' => 100
                ],
                'backend.plugin.edit_plugin' =>[
                    'label' => 'system::lang.permissions.manage_plugin.edit_plugin',
                    'tab' => 'system::lang.permissions.tab.manage_plugin',
                    'order' => 110
                ],
                'backend.plugin.update_plugin' =>[
                    'label' => 'system::lang.permissions.manage_plugin.update_plugin',
                    'tab' => 'system::lang.permissions.tab.manage_plugin',
                    'order' => 120
                ],


//                'backend.access_workflow' => [
//                    'label' => 'backend.access_workflow',
//                    'tab'   => 'system::lang.permissions.name'
//                ],
//                'backend.access_dashboard' => [
//                    'label' => 'system::lang.permissions.view_the_dashboard',
//                    'tab'   => 'system::lang.permissions.name'
//                ],
//                'backend.manage_users' => [
//                    'label' => 'system::lang.permissions.manage_other_administrators',
//                    'tab'   => 'system::lang.permissions.name'
//                ],
//                'backend.manage_preferences' => [
//                    'label' => 'system::lang.permissions.manage_preferences',
//                    'tab'   => 'system::lang.permissions.name'
//                ],
//                'backend.manage_editor' => [
//                    'label' => 'system::lang.permissions.manage_editor',
//                    'tab'   => 'system::lang.permissions.name'
//                ],
//                'backend.manage_branding' => [
//                    'label' => 'system::lang.permissions.manage_branding',
//                    'tab'   => 'system::lang.permissions.name'
//                ]
            ]);
        });
    }

    /*
     * Register widgets
     */
    protected function registerBackendWidgets()
    {
        WidgetManager::instance()->registerFormWidgets(function ($manager) {
            $manager->registerFormWidget('Backend\FormWidgets\CodeEditor', 'codeeditor');
            $manager->registerFormWidget('Backend\FormWidgets\RichEditor', 'richeditor');
            $manager->registerFormWidget('Backend\FormWidgets\MarkdownEditor', 'markdown');
            $manager->registerFormWidget('Backend\FormWidgets\FileUpload', 'fileupload');
            $manager->registerFormWidget('Backend\FormWidgets\Relation', 'relation');
            $manager->registerFormWidget('Backend\FormWidgets\DatePicker', 'datepicker');
            $manager->registerFormWidget('Backend\FormWidgets\TimePicker', 'timepicker');
            $manager->registerFormWidget('Backend\FormWidgets\ColorPicker', 'colorpicker');
            $manager->registerFormWidget('Backend\FormWidgets\DataTable', 'datatable');
            $manager->registerFormWidget('Backend\FormWidgets\RecordFinder', 'recordfinder');
            $manager->registerFormWidget('Backend\FormWidgets\Repeater', 'repeater');
            $manager->registerFormWidget('Backend\FormWidgets\TagList', 'taglist');
        });
    }

    /*
     * Register settings
     */
    protected function registerBackendSettings()
    {
        SettingsManager::instance()->registerCallback(function ($manager) {
            $manager->registerSettingItems('October.Backend', [
//                'branding' => [
//                    'label'       => 'backend::lang.branding.menu_label',
//                    'description' => 'backend::lang.branding.menu_description',
//                    'category'    => SettingsManager::CATEGORY_SYSTEM,
//                    'icon'        => 'icon-paint-brush',
//                    'class'       => 'Backend\Models\BrandSetting',
//                    'permissions' => ['backend.manage_branding'],
//                    'order'       => 500,
//                    'keywords'    => 'brand style'
//                ],
//                'editor' => [
//                    'label'       => 'backend::lang.editor.menu_label',
//                    'description' => 'backend::lang.editor.menu_description',
//                    'category'    => SettingsManager::CATEGORY_SYSTEM,
//                    'icon'        => 'icon-code',
//                    'class'       => 'Backend\Models\EditorSetting',
//                    'permissions' => ['backend.manage_editor'],
//                    'order'       => 500,
//                    'keywords'    => 'html code class style'
//                ],
                'myaccount' => [
                    'label'       => 'backend::lang.myaccount.menu_label',
                    'description' => 'backend::lang.myaccount.menu_description',
                    'category'    => SettingsManager::CATEGORY_MYSETTINGS,
                    'icon'        => 'icon-user',
                    'url'         => Backend::url('backend/users/myaccount'),
                    'order'       => 500,
                    'context'     => 'mysettings',
                    'keywords'    => 'backend::lang.myaccount.menu_keywords'
                ],
//                'preferences' => [
//                    'label'       => 'backend::lang.backend_preferences.menu_label',
//                    'description' => 'backend::lang.backend_preferences.menu_description',
//                    'category'    => SettingsManager::CATEGORY_MYSETTINGS,
//                    'icon'        => 'icon-laptop',
//                    'url'         => Backend::url('backend/preferences'),
//                    'permissions' => ['backend.manage_preferences'],
//                    'order'       => 510,
//                    'context'     => 'mysettings'
//                ],
//                'access_logs' => [
//                    'label'       => 'backend::lang.access_log.menu_label',
//                    'description' => 'backend::lang.access_log.menu_description',
//                    'category'    => SettingsManager::CATEGORY_LOGS,
//                    'icon'        => 'icon-lock',
//                    'url'         => Backend::url('backend/accesslogs'),
//                    'permissions' => ['system.access_logs'],
//                    'order'       => 920
//                ]
            ]);
        });
    }
}
