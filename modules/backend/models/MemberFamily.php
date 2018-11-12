<?php namespace Backend\Models;

use Model;

class MemberFamily extends Model
{
    /**
     * @var string The database table used by the model.
     */
    protected $table = 'backend_member_family';

    public $belongsToMany = [
        'users' => [User::class, 'table' => 'backend_users_family'],
    ];

    public function getGenderOptions()
    {
        return ['male' => '男性', 'female' => '女性'];
    }

    public function getRelationshipOptions()
    {
        return ['wife' => '妻', 'husband' => '夫', 'children' => '子'];
    }

    public function getGendersAttribute()
    {
        $value = array_get($this->attributes, 'gender');
        return array_get($this->getGenderOptions(), $value);
    }

    public function getRelationshipsAttribute()
    {
        $value = array_get($this->attributes, 'relationship');
        return array_get($this->getRelationshipOptions(), $value);
    }
}
