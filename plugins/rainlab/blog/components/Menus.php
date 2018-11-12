<?php
/**
 * Created by PhpStorm.
 * User: ken
 * Date: 31/01/2018
 * Time: 11:09
 */

namespace RainLab\Blog\Components;


use Backend\Classes\BackendMenu;
use Backend\Models\Menu;
use Cms\Classes\ComponentBase;
use RainLab\Blog\Models\Category;
use RainLab\Blog\Models\Tag;
use RainLab\Blog\Models\Post as Post;

class Menus extends ComponentBase
{
    /**
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name'        => 'backend::lang.menu.title',
            'description' => 'backend::lang.menu.description'
        ];
    }

    /**
     * @return array
     */
    public function getGlobalMenu()
    {
        $menu = Menu::where([
            'type' => 1,
            'is_active' => true
        ])->first();
        if ($menu) {
            return (array)json_decode($menu->menu_list);
        }
    }

    public function getFooterMenu()
    {
        $menu = Menu::where([
            'type' => 2,
            'is_active' => true
        ])->first();
        if ($menu) {
            return (array)json_decode($menu->menu_list);
        }
    }

    public function getSubMenu()
    {
        $menu = Menu::where([
            'type' => 3,
            'is_active' => true
        ])->first();
        if ($menu) {
            return (array)json_decode($menu->menu_list);
        }
    }

    /**
     * @param $type
     * @param $menu_id
     * @return bool|mixed
     */
    public function getMenuName($type, $menu_id)
    {
        return (new BackendMenu())->getMenuName($type, $menu_id);
    }

    /**
     * @param $type
     * @param $menu_id
     * @return bool
     */
    public function getMenuColor($type, $menu_id)
    {
        switch ($type) {

            case 'category':
                return $this->getCategoryColor($menu_id);
                break;
            case 'tag':
                return $this->getTagColor($menu_id);
                break;
            case 'page':
                return $this->getPageMenu($menu_id);
                break;
            default:
                return false;
        }
    }

    /**
     * @param $category_id
     * @return mixed
     */
    public function getCategoryColor($category_id)
    {
        if ($category = Category::find($category_id)) {
            return $category->color;
        }
    }

    /**
     * @param $tag_id
     * @return mixed
     */
    public function getTagColor($tag_id)
    {
        if ($tag = Tag::find($tag_id)) {
            return $tag->tag_color;
        }
    }

    public function getPageMenu($page_id)
    {
        return (new Posts())->getColorOfPost($page_id);
    }

    /**
     * @param $type
     * @param $menu_id
     * @return bool|string
     */
    public function getMenuLink($type, $menu_id)
    {
        switch ($type) {

            case 'category':
                return $this->getCategoryLink($menu_id);
                break;
            case 'tag':
                return $this->getTagLink($menu_id);
                break;
            case 'page':
                return $this->getPageLink($menu_id);
                break;
            default:
                return false;
        }
    }

    /**
     * @param $category_id
     * @return string
     */
    public function getCategoryLink($category_id)
    {
        if ($category = Category::find($category_id)) {
            return '/blog/category/' . $category->slug;
        }
    }

    /**
     * @param $tag_id
     * @return string
     */
    public function getTagLink($tag_id)
    {
        if ($tag = Tag::find($tag_id)) {
            return '/blog/tags/' . $tag->slug;
        }
    }

    public function getPageLink($page_id)
    {
        if ($page = Post::find($page_id)) {
            if ($page->is_page) {
                return '/blog/post/' . $page->slug;
            }
        }
    }

    public function getParentTag($post_id)
    {
        $post = Post::find($post_id);
        if ($post->parent_tag_list) {
            return (array)json_decode($post->parent_tag_list);
        }
    }

    public function getChildrenTag($post_id)
    {
        $post = Post::find($post_id);
        if ($post->children_tag_list) {
            return (array)json_decode($post->children_tag_list);
        }
    }
}