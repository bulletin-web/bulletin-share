<?php namespace RainLab\Blog\Models;

use Backend\Facades\BackendAuth;
use Model;

class Comment extends Model
{
    use \October\Rain\Database\Traits\Validation;

    protected $table = 'content_comment';

    public $rules = [
        'content' => 'required',
    ];

    public $attributeNames = [
        'content' => 'コメント'
    ];

    protected $fillable = ['name', 'email', 'content', 'post_id', 'user_updated_id'];

    public $belongsTo = [
        'posts' => ['RainLab\Blog\Models\Post', 'key' => 'post_id']
    ];

    public function beforeUpdate()
    {
        $this->user_updated_id = BackendAuth::getUser()->id;
    }
}