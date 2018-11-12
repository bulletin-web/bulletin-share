<?php

namespace Backend\Classes;

use Backend\Facades\BackendAuth;
use Illuminate\Support\Facades\App;
use RainLab\Blog\Models\Tag;
use Validator;
use Backend\Models\DisplaySetting;

class DisplaySettingController extends Controller
{
    public $rules = [
        'file_upload'       => 'mimes:jpeg,jpg,png,gif',
        'default_tag'  => 'required_if:display_special_page,==,0',
        'url_special_page'  => 'required_if:display_special_page,==,1|regex:/^(https?:\/\/)?([\da-z0-9\.-]+)\.([a-z0-9:\.]{2,6})([\/\w \.-]*)*\/?$/|between:1,255',
        'post_per_page'     => 'required|between:1,100|numeric',
    ];

    public function isCustomColor($value)
    {
        return !in_array($value, $this->availableColors());
    }

    public function checkInput($input, $database, $echo = null)
    {
        if (isset($input))
        {
            return $input;
        } else {
            return isset($database) ? $database : $echo;
        }
    }

    public function checkBoxInput($input, $database, $val, $echo)
    {
        if (isset($input))
        {
            return $input == $val ? $echo : null;
        } else {
            return isset($database) && $database == $val ? $echo : null;
        }
    }

    public function availableColors()
    {
        return [
            '#fefefe', '#000000', '#e6e5e5', '#425469', '#529ad2', '#f17c37', '#a4a4a4', '#febe26', '#3a73c1', '#6dac4d',
            '#f1f1f1', '#808080', '#cecccc', '#d3dbe3', '#dce9f5', '#fce3d5', '#ececec', '#fef1cd', '#d7e1f1', '#e1eed9',
            '#d8d8d8', '#595959', '#aeaaaa', '#aab8c8', '#bbd6ed', '#f9c9ac', '#dadada', '#fee49b', '#b1c5e5', '#c3df34',
            '#bebebe', '#404040', '#747070', '#8195ae', '#97c1e3', '#f7ae84', '#c8c8c8', '#fed76d', '#89a9d9', '#a5cf8f',
            '#a5a5a5', '#262626', '#3b3838', '#313e4e', '#1d74b2', '#c85819', '#7b7b7b', '#c18da1', '#275493', '#51803a',
            '#7e7e7e', '#0d0d0d', '#161616', '#202934', '#144d77', '#843a0f', '#525252', '#805e0e', '#1a3762', '#365626',
        ];
    }

    public function getDisplaySettingData()
    {
        return DisplaySetting::first();
    }

    public function getListTag()
    {
        return Tag::all();
    }

    public function uploadImage($file)
    {
        $file_name = time() . '.' . $file->getClientOriginalName();
        $file->move('storage/app/media', $file_name);
        return App::make('url')->to('/') . '/storage/app/media/' . $file_name;
    }

    public function insertDisplaySettingToDatabase($post)
    {
        if (isset($post['file_upload']))
        {
            $logo = $this->uploadImage($post['file_upload']);
        }
        $display = $this->getDisplaySettingData();

        if (isset($logo))
        {
            $logo = $logo;
        } else {
            $logo = isset($display->logo) ? $display->logo : "";
        }

        DisplaySetting::updateOrCreate(
            ['id' => isset($display->id) ? $display->id : 1],
            [
                'logo'                  => $logo,
                'menu_color'            => $post['menu_color'],
                'display_special_page'  => $post['display_special_page'],
                'url_special_page'      => isset($post['url_special_page']) ? $post['url_special_page'] : "",
                'default_tag'      => isset($post['default_tag']) ? $post['default_tag'] : 0,
                'slide_enable'          => isset($post['slide_enable']) ? $post['slide_enable'] : 0,
                'post_per_page'         => $post['post_per_page'],
                'user_created_id'       => isset($display->user_created_id) ? $display->user_created_id : BackendAuth::getUser()->id,
                'user_updated_id'       => BackendAuth::getUser()->id,
            ]
        );

        return TRUE;
    }

    public function validator($post)
    {
        return Validator::make($post, $this->rules);
    }
}