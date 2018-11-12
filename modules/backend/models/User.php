<?php namespace Backend\Models;

use Mail;
use Event;
use Backend;
use October\Rain\Auth\Models\User as UserBase;

/**
 * Administrator user model
 *
 * @package october\backend
 * @author Alexey Bobkov, Samuel Georges
 */
class User extends UserBase
{
    /**
     * @var string The database table used by the model.
     */
    protected $table = 'backend_users';

    /**
     * Validation rules
     */
    public $rules = [
        'first_name' => 'required|between:1,255',
        'last_name' => 'required|between:1,255',
        'gender' => 'required',
        'role' => 'required',
        'groups' => 'required',
        'email' => 'required|between:6,255|email|unique:backend_users',
//        'login' => 'required|between:2,255|unique:backend_users',
        'password' => 'required:create|between:4,255|confirmed',
        'password_confirmation' => 'required_with:password|between:4,255',
        'birthday' => 'nullable|date|before:today'
    ];

    /**
     * Relations
     */
    public $belongsToMany = [
        'member_family' => [MemberFamily::class, 'table' => 'backend_users_family'],
        'groups' => [UserGroup::class, 'table' => 'backend_users_groups']
    ];

    public $belongsTo = [
        'role' => UserRole::class
    ];

    public $attachOne = [
        'avatar' => \System\Models\File::class
    ];

    /**
     * Purge attributes from data set.
     */
    protected $purgeable = ['password_confirmation', 'send_invite'];

    /**
     * @var string Login attribute
     */
//    public static $loginAttribute = 'login';
    public static $loginAttribute = 'email';

    /**
     * @return string Returns the user's full name.
     */
    public function getFullNameAttribute()
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }

    /**
     * Gets a code for when the user is persisted to a cookie or session which identifies the user.
     * @return string
     */
    public function getPersistCode()
    {
        // Option A: @todo config
        // return parent::getPersistCode();

        // Option B:
        if (!$this->persist_code) {
            return parent::getPersistCode();
        }

        return $this->persist_code;
    }

    /**
     * Returns the public image file path to this user's avatar.
     */
    public function getAvatarThumb($size = 25, $options = null)
    {
        if (is_string($options)) {
            $options = ['default' => $options];
        }
        elseif (!is_array($options)) {
            $options = [];
        }

        // Default is "mm" (Mystery man)
        $default = array_get($options, 'default', 'mm');

        if ($this->avatar) {
            return $this->avatar->getThumb($size, $size, $options);
        }
        else {
            return '//www.gravatar.com/avatar/' .
                md5(strtolower(trim($this->email))) .
                '?s='. $size .
                '&d='. urlencode($default);
        }
    }

    /**
     * After create event
     * @return void
     */
    public function afterCreate()
    {
        $this->restorePurgedValues();

//        if ($this->send_invite) {
//            $this->sendInvitation();
//        }
//        $this->sendInvitation();
    }

    /**
     * After login event
     * @return void
     */
    public function afterLogin()
    {
        parent::afterLogin();
        Event::fire('backend.user.login', [$this]);
    }

    /**
     * Sends an invitation to the user using template "backend::mail.invite".
     * @return void
     */
    public function sendInvitation()
    {
        $data = [
            'name' => $this->full_name,
//            'login' => $this->login,
            'email' => $this->email,
            'password' => $this->getOriginalHashValue('password'),
            'link' => Backend::url('backend'),
        ];

        Mail::send('backend::mail.invite', $data, function ($message) {
            $message->to($this->email, $this->full_name);
        });
    }

    public function getGroupsOptions()
    {
        $result = [];
        $groups = UserGroup::orderBy('display_order')->get();
        foreach ($groups as $group) {
            $result[$group->id] = [$group->name, $group->description];
        }

        return $result;
    }

    public function getRoleOptions()
    {
        $result = [];

        foreach (UserRole::all() as $role) {
            $result[$role->id] = $role->name;
        }

        if (!Backend\Facades\BackendAuth::getUser()->is_superuser)
        {
            unset($result[1]);
        }

        return $result;
    }

    public function getGenderOptions()
    {
        return ['male' => '男性', 'female' => '女性'];
    }
}