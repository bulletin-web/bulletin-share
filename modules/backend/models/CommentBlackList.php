<?php namespace Backend\Models;

use Backend\Facades\BackendAuth;
use Model;

class CommentBlackList extends Model
{
    use \October\Rain\Database\Traits\Validation;

    protected $table = 'comment_blacklist';

    public $rules = [
        'phrase' => 'required|unique:comment_blacklist'
    ];

    public $attributeNames = [
        'phrase' => 'ワード'
    ];
}