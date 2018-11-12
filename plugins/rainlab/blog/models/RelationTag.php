<?php
/**
 * Created by PhpStorm.
 * User: ken
 * Date: 22/01/2018
 * Time: 14:03
 */

namespace RainLab\Blog\Models;
use Model;

class RelationTag extends Model
{
    protected $table = 'content_tag_parent_children';

    protected $fillable = ['parent_tag_id', 'children_tag_id'];

    public $belongsTo = [
        'parent_tag' => ['RainLab\Blog\Models\Tag',
            'key' => 'parent_tag_id'
        ],
        'children_tag' => ['RainLab\Blog\Models\Tag',
            'key' => 'children_tag_id']
    ];
}