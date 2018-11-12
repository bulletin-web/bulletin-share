<?php namespace Backend\Controllers;

use Backend\Classes\Controller;
use Response;
use Backend\Facades\BackendAuth;

class Notify extends Controller
{
    public function getData()
    {
        $loginId = BackendAuth::getUser()->id;
        $data = app('backend.notify')->getListNotify($loginId);
        return Response::json($data);
    }

}
