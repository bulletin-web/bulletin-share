<?php namespace RainLab\Blog\Models;

use Illuminate\Support\Facades\App;
use Model;

class Tag extends Model
{
    use \October\Rain\Database\Traits\Validation;

    protected $table = 'content_tag';

    public $rules = [
        'name' => 'required|unique:content_tag|between:1,64',
        'slug' => 'required|unique:content_tag|between:1,64|regex:/^[a-z0-9][-a-z0-9]*$/',
        'tag_color' => 'required'
    ];

    public $attributeNames = [
        'name' => 'タグ名',
        'category_id' => 'カテゴリー',
        'parent_tag_id' => '親タグ'
    ];

    public $belongsToMany = [
        'posts' => [
            'RainLab\Blog\Models\Post',
            'table' => 'rainlab_blog_posts_tags',
        ]
    ];

    public $belongsTo = [
        'categories' => ['RainLab\Blog\Models\Category', 'key' => 'category_id']
    ];

    public $hasMany = [
        'children' => ['RainLab\Blog\Models\Tag', 'key' => 'parent_tag_id'],
        'relation_tag' => [
            'RainLab\Blog\Models\RelationTag',
            'key' => 'children_tag_id'
        ],
        'children_tag' => [
            'RainLab\Blog\Models\RelationTag',
            'key' => 'parent_tag_id'
        ]
    ];

    public function beforeSave() {
        $this->name = strip_tags($this->name);
    }

    public function listCategory()
    {
        return $this->getListCategory();
    }

    public function getListCategory()
    {
        foreach (Category::all() as $category)
        {
            $listCategory[$category->id] = $category->name;
        }
        return $listCategory;
    }

    public function getPostCountAttribute()
    {
        return $this->posts->count();
    }

    public function getParentTagIdOptions()
    {
        $result = [];
        $result[0] = '親タグとして設定';

        foreach (Tag::all() as $tag)
        {
            if (is_null($this->id)) {
                if ($this->isParentTag($tag) && $tag->categories->id == $this->category_id)
                {
                    $result[$tag->id] = $tag->name;
                }
            } else {
                if ($this->isParentTag($tag) && $tag->id != $this->id &&
                    $tag->categories->id == $this->category_id && !$this->isChildTag($this->id, $tag))
                {
                    $result[$tag->id] = $tag->name;
                }
            }

        }

        return $result;
    }

    private function isParentTag($tag)
    {
        if (Tag::where('parent_tag_id', $tag->id)->exists() || $tag->parent_tag_id == 0)
        {
            return true;
        }
        return false;
    }

    private function isChildTag($id, $tag)
    {
        $listChild = [];

        $currentTag = Tag::find($id);

        if ($currentTag->children->isNotEmpty()){
            foreach ($currentTag->children as $item) {
                $listChild[] = $item->id;
            }
        }

        if (in_array($tag->id, $listChild)) {
            return true;
        }

        return false;
    }

    public function getParentTagNameAttribute()
    {
        if ($this->parent_tag_id == 0)
        {
            return '親タグとして';
        } else {
            $parent = Tag::where('id', $this->parent_tag_id)->first();
            return $parent->name;
        }
    }
}