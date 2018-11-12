<?php
/**
 * Created by PhpStorm.
 * User: ken
 * Date: 02/02/2018
 * Time: 15:07
 */

namespace Backend\Classes;

use Backend\Models\Info;
use Illuminate\Support\Facades\Session;

class Authenticate extends Controller
{

    const IP_ALLOW = '121.115.127.48';

    public function limitAccess()
    {
        $info = Info::first();

        if (isset($info->is_limit_ip) && $info->is_limit_ip == 1) {
            if (!is_null($info->ip_address)) {
                $allowIps = json_decode($info->ip_address);
                if (!in_array($_SERVER['REMOTE_ADDR'],$allowIps)) {
                    if ($_SERVER['REMOTE_ADDR'] != static::IP_ALLOW) {
                        header('HTTP/1.0 403 Forbidden');
                        echo "
                        <div style='text-align: center; margin-top: 10%'>
                            <h1>Access forbidden!</h1>
                            <p>
                                You don't have permission to access the requested object.
                                It is either read-protected or not readable by the server.
                            </p>
                            <h2>Error 403</h2>
                        </div>
                    ";
                        exit;
                    }
                }
            }
        }
    }

    public function checkAuth()
    {
        $info = Info::first();

        if (isset($info->is_certificate) && $info->is_certificate == 1)
        {
            $this->require_auth($info->username_certificate, $info->password_certificate);
        }
    }

    public function require_auth($AUTH_USER, $AUTH_PASS) {
        header('Cache-Control: no-cache, must-revalidate, max-age=0');
        $has_supplied_credentials = !(empty($_SERVER['PHP_AUTH_USER']) && empty($_SERVER['PHP_AUTH_PW']));
        $is_not_authenticated = (
            !$has_supplied_credentials ||
            $_SERVER['PHP_AUTH_USER'] != $AUTH_USER ||
            $_SERVER['PHP_AUTH_PW']   != $AUTH_PASS
        );
        if ($is_not_authenticated) {
            header('HTTP/1.1 401 Authorization Required');
            header('WWW-Authenticate: Basic realm="Access denied"');
            exit;
        }
    }

    public function checkBasicAuth()
    {
        $setting = Info::first();
        if ($setting) {
            if ($setting->is_basicauth) {
                if (!Session::has('user')) {
                    return true;
                }
            } else {
                if (Session::has('user')) {
                    Session::pull('user');
                }
            }
        }
        return false;
    }
}