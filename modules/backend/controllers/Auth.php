<?php namespace Backend\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Mail;
use Flash;
use Backend;
use Validator;
use BackendAuth;
use Backend\Models\AccessLog;
use Backend\Classes\Controller;
use System\Classes\UpdateManager;
use ApplicationException;
use ValidationException;
use Exception;
use Backend\Models\User as User;
use Backend\Models\DisplaySetting as Setting;

/**
 * Authentication controller
 *
 * @package october\backend
 * @author Alexey Bobkov, Samuel Georges
 *
 */
class Auth extends Controller
{
    /**
     * @var array Public controller actions
     */
    protected $publicActions = ['index', 'signin', 'signout', 'restore', 'reset', 'login'];
    public $setting;

    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->layout = 'auth';
    }

    /**
     * Default route, redirects to signin.
     */
    public function index()
    {
        return Backend::redirect('backend/auth/signin');
    }

    public function login()
    {
        $setting = Backend\Models\Info::first();
        if ($setting) {
            if (!$setting->is_basicauth) {
                return Redirect::to('/');
            }
        }
        if (Session::get('user') == true) {
            return Redirect::to('/');
        }
        $this->setting = Setting::first();
        $this->bodyClass = 'signin';

        try {
            if (post('postback')) {
                return $this->login_onSubmit();
            }
            else {
                $this->bodyClass .= ' preload';
            }
        }
        catch (Exception $ex) {
            Flash::error($ex->getMessage());
        }
    }

    public function login_onSubmit()
    {
        $rules = [
            'email'    => 'required|email',
            'password' => 'required|between:4,255'
        ];

        $validation = Validator::make(post(), $rules);
        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

        $user = User::where('email', post('email'));
        if (!$user->exists() || !Hash::check(post('password'), $user->first()->password)) {
            throw new ValidationException([e(trans('backend::lang.account.id_pass_incorrect'))]);
        }
        Session::put('user', true);
        return Redirect::to('/');
    }

    /**
     * Displays the log in page.
     */
    public function signin()
    {
        $this->bodyClass = 'signin';

        try {
            if (post('postback')) {
                return $this->signin_onSubmit();
            }
            else {
                $this->bodyClass .= ' preload';
            }
        }
        catch (Exception $ex) {
            Flash::error($ex->getMessage());
        }
    }

    public function signin_onSubmit()
    {
        $rules = [
//            'login'    => 'required|between:2,255',
            'email'    => 'required|email',
            'password' => 'required|between:4,255'
        ];

        $validation = Validator::make(post(), $rules);
        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

        $user = User::where('email', post('email'));
        if (!$user->exists() || !Hash::check(post('password'), $user->first()->password)) {
            throw new ValidationException([e(trans('backend::lang.account.id_pass_incorrect'))]);
        }

        if (is_null($remember = config('cms.backendForceRemember', true))) {
            $remember = (bool) post('remember');
        }

        // Authenticate user
        $user = BackendAuth::authenticate([
//            'login' => post('login'),
            'email' => post('email'),
            'password' => post('password')
        ], $remember);

        // Load version updates
        UpdateManager::instance()->update();

        // Log the sign in event
        AccessLog::add($user);

        // Redirect to the intended page after successful sign in
        return Backend::redirect('system/settings');
    }

    /**
     * Logs out a backend user.
     */
    public function signout()
    {
        BackendAuth::logout();
        return Backend::redirect('backend');
    }

    /**
     * Request a password reset verification code.
     */
    public function restore()
    {
        try {
            if (post('postback')) {
                return $this->restore_onSubmit();
            }
        }
        catch (Exception $ex) {
            Flash::error($ex->getMessage());
        }
    }

    public function restore_onSubmit()
    {
        $rules = [
//            'login' => 'required|between:2,255'
            'email' => 'required|email'
        ];

        $validation = Validator::make(post(), $rules);
        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

//        $user = BackendAuth::findUserByLogin(post('login'));
        $user = BackendAuth::findUserByLogin(post('email'));
        if (!$user) {
            throw new ValidationException([
                'email' => trans('backend::lang.account.restore_error', ['login' => post('email')])
            ]);
        }

        Flash::success(trans('backend::lang.account.restore_success'));

        $code = $user->getResetPasswordCode();
        $link = Backend::url('backend/auth/reset/'.$user->id.'/'.$code);

        $data = [
            'name' => $user->full_name,
            'link' => $link,
        ];

        Mail::send('backend::mail.restore', $data, function ($message) use ($user) {
            $message->to($user->email, $user->full_name)->subject(trans('backend::lang.account.password_reset'));
        });

        return Backend::redirect('backend/auth/signin');
    }

    /**
     * Reset backend user password using verification code.
     */
    public function reset($userId = null, $code = null)
    {
        try {
            if (post('postback')) {
                return $this->reset_onSubmit();
            }

            if (!$userId || !$code) {
                throw new ApplicationException(trans('backend::lang.account.reset_error'));
            }
        }
        catch (Exception $ex) {
            Flash::error($ex->getMessage());
        }

        $this->vars['code'] = $code;
        $this->vars['id'] = $userId;
    }

    public function reset_onSubmit()
    {
        if (!post('id') || !post('code')) {
            throw new ApplicationException(trans('backend::lang.account.reset_error'));
        }

        $rules = [
            'password' => 'required|between:4,255'
        ];

        $validation = Validator::make(post(), $rules);
        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

        $code = post('code');
        $user = BackendAuth::findUserById(post('id'));

        if (!$user->checkResetPasswordCode($code)) {
            throw new ApplicationException(trans('backend::lang.account.reset_error'));
        }

        if (!$user->attemptResetPassword($code, post('password'))) {
            throw new ApplicationException(trans('backend::lang.account.reset_fail'));
        }

        $user->clearResetPassword();

        Flash::success(trans('backend::lang.account.reset_success'));

        return Backend::redirect('backend/auth/signin');
    }
}
