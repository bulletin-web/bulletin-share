<?php namespace Backend\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Illuminate\Support\Facades\Input;
use System\Classes\SettingsManager;
use Illuminate\Support\Facades\Redirect;
use Backend;
use Illuminate\Support\Facades\Session;

class Backup extends Controller
{
    public $data;

    public $requiredPermissions = ['backend.access_backup'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('October.System', 'system', 'users');
        SettingsManager::setContext('October.System', 'site_backup');
    }


    public function index()
    {
        $this->pageTitle = "backend::lang.site-backup.title";
        $this->data = app('backend.backup')->getData();

        if (Session::get('backup')) {
            $this->data = Session::get('backup');
        }
    }

    public function zipmedia()
    {
        $output = app('backend.backup')->backupMedia();
        app('backend.backup')->downloadFile($output);
        return Redirect::back()->withSuccess('Success');

    }

    public function exportDatabase()
    {
        $output = app('backend.backup')->dumpSql();

        if (!$output) {
            return Redirect::back()->withError('エラーが発生しました。');
        }

        app('backend.backup')->downloadFile($output);
        return Redirect::back()->withSuccess('Success');
    }

    public function setting()
    {
        if (post())
        {
            $validator = app('backend.backup')->validation(post());

            if ($validator->fails()) {
                $data = (object)post();
                return Redirect::back()->withErrors($validator)->withBackup($data);
            }
            
            if (app('backend.backup')->store(post()))
            {
                return Redirect::back()->withSuccess(trans('backend::lang.site-backup.setting_success'));
            }
        }

        return Redirect::to(Backend::url('backend/backup'));
    }

    public function importSql()
    {
        if (Input::hasFile('fileImport'))
        {
            $file = Input::file('fileImport');

            if ($file->getClientOriginalExtension() == 'sql') {
                if (app('backend.backup')->importSql($file)) {
                    return Redirect::back()->withSuccess(trans('backend::lang.site-backup.import_success'));
                }
            }
        }

        return Redirect::to(Backend::url('backend/backup'))
            ->withError(trans('backend::lang.site-backup.import_fail'));
    }
}
