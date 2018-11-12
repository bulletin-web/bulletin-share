<?php namespace Backend\Controllers;


use Backend\Classes\Controller;
use Backend\Facades\Backend;
use Backend\Facades\BackendMenu;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use System\Classes\SettingsManager;

class DisplaySetting extends Controller
{
    public $data;

    public $tags;

    public $availableColors;

    public $requiredPermissions = ['backend.site_display_setting'];

    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->addCss('/modules/backend/formwidgets/colorpicker/assets/vendor/spectrum/spectrum.css', 'core');
        $this->addCss('/modules/backend/formwidgets/colorpicker/assets/css/colorpicker.css', 'core');
        $this->addJs('/modules/backend/widgets/form/assets/js/october.form.js', 'core');
        $this->addJs('/modules/backend/formwidgets/colorpicker/assets/vendor/spectrum/spectrum.js', 'core');
        $this->addJs('/modules/backend/formwidgets/colorpicker/assets/js/colorpicker.js', 'core');

        BackendMenu::setContext('October.System', 'system', 'users');
        SettingsManager::setContext('October.System', 'site_display');
    }

    public function index()
    {
        $this->pageTitle = "backend::lang.display_setting.title";
        $this->data = app('display.setting')->getDisplaySettingData();
        $this->tags = app('display.setting')->getListTag();
        $this->availableColors = app('display.setting')->availableColors();

    }

    public function store()
    {
        if (post())
        {
            $validator = app('display.setting')->validator(Input::all()['Display']);
            if ($validator->fails())
            {
                return Redirect::back()->with([
                    'error' => $validator->messages(),
                    'post' => post()['Display'],
                ]);
            } else {
                $import = app('display.setting')->insertDisplaySettingToDatabase(Input::all()['Display']);
                if ($import == TRUE)
                {
                    return Redirect::back()->withSuccess(e(trans('system::lang.saved.success')));
                }
            }
        }

        return Redirect::to(Backend::url('backend/displaysetting'));
    }

    public function checkInput($input, $database, $echo = null)
    {
        return app('display.setting')->checkInput($input, $database, $echo);
    }

    public function checkBoxInput($input, $database, $val, $echo)
    {
        return app('display.setting')->checkBoxInput($input, $database, $val, $echo);
    }

    public function isCustomColor($value)
    {
        return app('display.setting')->isCustomColor($value);
    }
}