<?php namespace Backend\Controllers;

use Validator;
use BackendMenu;
use BackendAuth;
use Backend\Classes\Controller;
use Illuminate\Support\Facades\Redirect;
use System\Classes\SettingsManager;

/**
 * Backend user groups controller
 *
 * @package october\backend
 * @author Alexey Bobkov, Samuel Georges
 *
 */
class Info extends Controller
{
    public $data;

    /**
     * @var array Permissions required to view this page.
     */
    public $requiredPermissions = ['backend.site_infos'];

    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('October.System', 'system', 'users');
        SettingsManager::setContext('October.System', 'site_infos');
    }

    public function index()
    {
        $this->pageTitle = "backend::lang.info_setting.title";
        $this->data = app('backend.info')->getData();
    }

    public function store()
    {
        if (post())
        {
            $validator = app('backend.info')->validationPost(post('Info'));
            if ($validator->fails())
            {
                return Redirect::back()->withError([
                    'posts' => post('Info'),
                    'message' => $validator->messages()
                ]);
            } else {
                app('backend.info')->insertSiteInfoSetting(post('Info'));
                return Redirect::back()->withSuccess(e(trans('system::lang.saved.success')));
            }
        }
    }

    public function checkInput($input, $database, $val = null)
    {
        return app('backend.info')->checkInput($input, $database, $val);
    }
}