<?php
/**
 * Created by PhpStorm.
 * User: ken
 * Date: 31/01/2018
 * Time: 10:06
 */

namespace Backend\Classes;


use Backend\Models\Menu;
use RainLab\Blog\Models\Category;
use RainLab\Blog\Models\Post;
use RainLab\Blog\Models\Tag;

class BackendMenu extends Controller
{

    /**
     * @return array
     */
    public function getListCategory()
    {
        $categories = [];
        if (Category::all()) {
            foreach (Category::all() as $category) {
                $categories[$category->id] = $category;
            }
        }
        return $categories;
    }

    /**
     * @return array
     */
    public function getListTag()
    {
        $tags = [];
        if (Tag::all()) {
            foreach (Tag::all() as $tag) {
                $tags[$tag->id] = $tag;
            }
        }
        return $tags;
    }

    /**
     * @return array
     */
    public function getListPage()
    {
        $pages = [];
        $listPage = Post::where([
            'is_page' => true,
            'published' => true
        ])->get();
        if ($listPage) {
            foreach ($listPage as $page) {
                $pages[$page->id] = $page;
            }
        }
        return $pages;
    }

    /**
     * @param $menu_id
     * @return mixed
     */
    public function getListMenu($menu_id)
    {
        $listMenu = Menu::find($menu_id)->menu_list;
        return json_decode($listMenu);
    }

    /**
     * @param $type
     * @param $menu_id
     * @return bool|mixed
     */
    public function getMenuName($type, $menu_id)
    {
        switch ($type) {

            case 'category':
                return $this->getCategoryName($menu_id);
                break;
            case 'tag':
                return $this->getTagName($menu_id);
                break;
            case 'page':
                return $this->getPageName($menu_id);
                break;
            default:
                return false;
        }
    }

    /**
     * @param $category_id
     * @return mixed
     */
    public function getCategoryName($category_id)
    {
        if ($category = Category::find($category_id)) {
            return $category->name;
        }
    }

    /**
     * @param $tag_id
     * @return mixed
     */
    public function getTagName($tag_id)
    {
        if ($tag = Tag::find($tag_id)) {
            return $tag->name;
        }
    }

    /**
     * @param $page_id
     * @return mixed
     */
    public function getPageName($page_id)
    {
        if ($page = Post::find($page_id)) {
            if ($page->is_page) {
                return $page->title;
            }
        }
    }

    /**
     * @param $type
     * @return bool|string
     */
    public function getMenuType($type)
    {
        switch ($type) {

            case 'category':
                return e(trans('rainlab.blog::lang.categories.list_title'));
                break;
            case 'tag':
                return e(trans('rainlab.blog::lang.tag.title'));
                break;
            case 'page':
                return e(trans('rainlab.blog::lang.page.title'));
                break;
            default:
                return false;
        }
    }

    /**
     * @param $menu_id
     * @return array
     */
    public function getCurrentListCategory($menu_id)
    {
        $listMenu = $this->getListMenu($menu_id);
        $listCategory = $this->getListCategory();
        foreach ($listMenu as $menu) {
            if ($menu->type === 'category') {
                unset($listCategory[$menu->id]);
            }
        }
        return $listCategory;
    }

    /**
     * @param $menu_id
     * @return array
     */
    public function getCurrentListTag($menu_id)
    {
        $listMenu = $this->getListMenu($menu_id);
        $listTag = $this->getListTag();
        foreach ($listMenu as $menu) {
            if ($menu->type === 'tag') {
                unset($listTag[$menu->id]);
            }
        }
        return $listTag;
    }

    /**
     * @param $menu_id
     * @return array
     */
    public function getCurrentListPage($menu_id)
    {
        $listMenu = $this->getListMenu($menu_id);
        $listPage = $this->getListPage();
        foreach ($listMenu as $menu) {
            if ($menu->type === 'page') {
                unset($listPage[$menu->id]);
            }
        }
        return $listPage;
    }

    /**
     * @return array
     */
    public function getListMenuGlobal()
    {
        $tags = [];
        $menu = Menu::where('type', true)
            ->where('is_active', true)
            ->first();
        if ($menu) {
            foreach (json_decode($menu->menu_list) as $value) {
                if ($value->type == 'tag') {
                    array_push($tags, $value->id);
                }
            }
        }
        return $tags;
    }
}