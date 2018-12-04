<?php namespace RainLab\Blog\Models;

use Backend\Facades\BackendAuth;
use Model;

class Comment extends Model
{
    use \October\Rain\Database\Traits\Validation;

    protected $table = 'content_comment';

    public $rules = [

    ];

    public $attributeNames = [
        'content' => 'コメント'
    ];

    protected $fillable = ['name', 'email', 'content', 'post_id', 'user_updated_id', 'age', 'sex', 'others_item'];

    public $belongsTo = [
        'posts' => ['RainLab\Blog\Models\Post', 'key' => 'post_id']
    ];

    public function beforeUpdate()
    {
        $this->user_updated_id = BackendAuth::getUser()->id;
    }
}
