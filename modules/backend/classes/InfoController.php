<?php
/**
 * Created by PhpStorm.
 * User: ken
 * Date: 16/10/2017
 * Time: 09:29
 */

namespace Backend\Classes;

use Validator;
use Backend\Facades\BackendAuth;
use Backend\Models\Info;

class InfoController extends Controller
{
    public $rules = [
        'site_name' => 'required|between:1,255',
        'site_url'      => 'required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/|between:1,255',
        'copyright' => 'max:255',
        'ip_address.*' => 'required_if:is_limit_ip,==,1|ip',
        'admin_email'   => 'required|email|between:1,255',
        'license' => 'between:1,255',
        'username_certificate' => 'required_if:is_certificate,==,1|between:1,255',
        'password_certificate' => 'required_if:is_certificate,==,1|between:1,255',
    ];

    public function messages($post){
        $messages = [];

        if (isset($post['ip_address'])) {
            foreach ($post['ip_address'] as $key => $val) {
                $index = ($key + 1);
                $messages["ip_address.$key.required_if"] = "IPアドレス" . $index . "位を指定してください。";
                $messages["ip_address.$key.ip"] = "IPアドレス" . $index . "位には、有効なIPアドレスを指定してください。";
            }
        }

        return $messages;
    }

    public function getData()
    {
        return Info::first();
    }

    public function insertSiteInfoSetting($post)
    {
        $info = $this->getData();
        Info::updateOrCreate(
            ['id' => isset($info->id) ? $info->id : 1],
            [
                'status'                => $post['status'],
                'site_name'             => $post['site_name'],
                'site_url'              => $post['site_url'],
                'copyright'              => $post['copyright'],
                'is_limit_ip'           => $post['is_limit_ip'],
                'ip_address'            => $this->generateIpAddress($post),
                'is_certificate'        => $post['is_certificate'],
                'is_basicauth'          => $post['is_basicauth'],
                'username_certificate'  => isset($post['username_certificate']) ? $post['username_certificate'] : null,
                'password_certificate'  => isset($post['password_certificate']) ? $post['password_certificate'] : null,
                'admin_email'           => $post['admin_email'],
                'searchable'            => $post['searchable'],
                'access_analysis_tag'   => $post['access_analysis_tag'],
                'license'               => $post['license'],
                'accept_facebook'       => $post['accept_facebook'],
                'accept_twitter'        => $post['accept_twitter'],
                'user_create_id'        => isset($info->user_create_id) ? $info->user_create_id : BackendAuth::getUser()->id,
                'user_update_id'        => BackendAuth::getUser()->id,
            ]
        );
    }

    protected function generateIpAddress($post)
    {
        if (isset($post['ip_address']) && count($post['ip_address']))
        {
            return json_encode($post['ip_address']);
        }

        return null;
    }

    public function validationPost($post)
    {
        return Validator::make($post, $this->rules, $this->messages($post));
    }

    public function checkInput($input, $database, $val = null)
    {
        if ($val == null)
        {
            if (isset($input))
            {
                return $input;
            } else {
                return isset($database) ? $database : null;
            }
        } else {
            if (isset($input))
            {
                return $input == $val ? "checked" : null;
            } else {
                return isset($database) && $database == $val ? "checked" : null;
            }
        }
    }
}