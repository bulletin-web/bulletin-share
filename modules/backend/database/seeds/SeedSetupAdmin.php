<?php namespace Backend\Database\Seeds;

use Illuminate\Support\Facades\DB;
use Seeder;
use Backend\Models\User;
use Backend\Models\UserRole;
use Backend\Models\UserGroup;

class SeedSetupAdmin extends Seeder
{
    public static $email = 'admin@domain.tld';
    public static $login = 'admin';
    public static $password = 'admin';
    public static $firstName = 'Admin';
    public static $lastName = 'Person';
    public static $gender = 'male';

    public function setDefaults($values)
    {
        if (!is_array($values)) {
            return;
        }
        foreach ($values as $attribute => $value) {
            static::$$attribute = $value;
        }
    }

    public function run()
    {
        $role = UserRole::create([
            'name' => '管理者',
            'code' => UserRole::CODE_DEVELOPER,
            'description' => 'Site administrator with access to developer tools.',
        ]);

        $group = UserGroup::create([
            'name' => 'Owners',
            'code' => UserGroup::CODE_OWNERS,
            'description' => 'Default group for website owners.',
            'is_new_user_default' => false,
            'display_order' => 1
        ]);

        $user = User::create([
            'email'                 => static::$email,
            'login'                 => static::$login,
            'password'              => static::$password,
            'password_confirmation' => static::$password,
            'first_name'            => static::$firstName,
            'last_name'             => static::$lastName,
            'gender'                => static::$gender,
            'role'                  => UserRole::first()->id,
            'permissions'           => [],
            'is_superuser'          => true,
            'is_activated'          => true,
            'role_id'               => $role->id,
            'groups'                => $group->id,
        ]);

        $user->addGroup($group);
    }
}
