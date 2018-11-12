<?php namespace RainLab\Blog\Components;

use RainLab\Blog\Models\Tag;
use Cms\Classes\ComponentBase;

class Tags extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'rainlab.blog::lang.settings.tag_title',
            'description' => 'rainlab.blog::lang.settings.tag_description'
        ];
    }

    /**
     * Get list tags by limit
     *
     * @param int $limit number item display
     *
     * @return mixed
     */
    public function getLimitTag($limit)
    {
        return Tag::orderBy('id', 'desc')
            ->where('parent_tag_id', 0)
            ->take($limit)
            ->get();
    }

    /**
     * @param $limit
     * @return mixed
     */
    public function getParentTagList($limit)
    {
        return Tag::orderBy('id', 'desc')
            ->where('is_parent', true)
            ->take($limit)
            ->get();
    }

    /**
     * Get child tag of current tag
     *
     * @param int $tagId
     *
     * @return mixed
     */
    public function getChildTagsByCurrentTag($tagId)
    {
        $currentTag = Tag::find($tagId);

        if ($currentTag) {
            return $currentTag->children_tag;
        }

        return null;
    }
}
