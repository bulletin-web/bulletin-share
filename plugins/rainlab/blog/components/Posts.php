<?php namespace RainLab\Blog\Components;

use Backend\Classes\ContentTag;
use Backend\Models\DisplaySetting;
use Backend\Models\SiteBar;
use RainLab\Blog\Models\Tag as BlogTag;
use RainLab\Blog\Models\Tag;
use Redirect;
use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use RainLab\Blog\Models\Post as BlogPost;
use RainLab\Blog\Models\Category as BlogCategory;
use Db;

class Posts extends ComponentBase
{
    /**
     * A collection of posts to display
     * @var Collection
     */
    public $posts;

    /**
     * Parameter to use for the page number
     * @var string
     */
    public $pageParam;

    /**
     * If the post list should be filtered by a category, the model to use.
     * @var Model
     */
    public $category;

    /**
     * Message to display when there are no messages.
     * @var string
     */
    public $noPostsMessage;

    /**
     * Reference to the page name for linking to posts.
     * @var string
     */
    public $postPage;

    /**
     * Reference to the page name for linking to categories.
     * @var string
     */
    public $categoryPage;

    /**
     * If the post list should be ordered by another attribute.
     * @var string
     */
    public $sortOrder;

    public $searchParam;

    public $tag;

    public $postsByCate;

    public $postsByTag;

    public function componentDetails()
    {
        return [
            'name'        => 'rainlab.blog::lang.settings.posts_title',
            'description' => 'rainlab.blog::lang.settings.posts_description'
        ];
    }

    public function defineProperties()
    {
        return [
            'pageNumber' => [
                'title'       => 'rainlab.blog::lang.settings.posts_pagination',
                'description' => 'rainlab.blog::lang.settings.posts_pagination_description',
                'type'        => 'string',
                'default'     => '{{ :page }}',
            ],
            'categoryFilter' => [
                'title'       => 'rainlab.blog::lang.settings.posts_filter',
                'description' => 'rainlab.blog::lang.settings.posts_filter_description',
                'type'        => 'string',
                'default'     => ''
            ],
            'postsPerPage' => [
                'title'             => 'rainlab.blog::lang.settings.posts_per_page',
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'rainlab.blog::lang.settings.posts_per_page_validation',
                'default'           => '10',
            ],
            'noPostsMessage' => [
                'title'        => 'rainlab.blog::lang.settings.posts_no_posts',
                'description'  => 'rainlab.blog::lang.settings.posts_no_posts_description',
                'type'         => 'string',
                'default'      => 'No posts found',
                'showExternalParam' => false
            ],
            'sortOrder' => [
                'title'       => 'rainlab.blog::lang.settings.posts_order',
                'description' => 'rainlab.blog::lang.settings.posts_order_description',
                'type'        => 'dropdown',
                'default'     => 'published_at desc'
            ],
            'categoryPage' => [
                'title'       => 'rainlab.blog::lang.settings.posts_category',
                'description' => 'rainlab.blog::lang.settings.posts_category_description',
                'type'        => 'dropdown',
                'default'     => 'blog/category',
                'group'       => 'Links',
            ],
            'postPage' => [
                'title'       => 'rainlab.blog::lang.settings.posts_post',
                'description' => 'rainlab.blog::lang.settings.posts_post_description',
                'type'        => 'dropdown',
                'default'     => 'blog/post',
                'group'       => 'Links',
            ],
            'exceptPost' => [
                'title'             => 'rainlab.blog::lang.settings.posts_except_post',
                'description'       => 'rainlab.blog::lang.settings.posts_except_post_description',
                'type'              => 'string',
                'validationPattern' => 'string',
                'validationMessage' => 'rainlab.blog::lang.settings.posts_except_post_validation',
                'default'           => '',
                'group'             => 'Exceptions',
            ],
			'tagFilter' => [
				'title'       => 'rainlab.blog::lang.settings.posts_filter',
				'description' => 'rainlab.blog::lang.settings.posts_filter_description',
				'type'        => 'string',
				'default'     => ''
			],
			'search' => [
				'title'       => 'Text to search',
				'description' => 'Text to search',
				'type'        => 'string',
				'default'     => ''
			]
        ];
    }

    public function getCategoryPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function getPostPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function getSortOrderOptions()
    {
        return BlogPost::$allowedSortingOptions;
    }

    public function onRun()
    {
        $this->prepareVars();

        $this->category = $this->page['category'] = $this->loadCategory();
        $this->posts = $this->page['posts'] = $this->listPosts();
        $this->tag = $this->page['tag'] = $this->loadTag();
        $this->postsByCate = $this->page['postsByCate'] = $this->listPostsByCate();
        $this->postsByTag = $this->page['postsByTag'] = $this->listPostsByTag();

        $this->page['siteBar'] = SiteBar::getListSiteBar();

        /*
         * If the page number is not valid, redirect
         */
        if ($pageNumberParam = $this->paramName('pageNumber')) {
            $currentPage = $this->property('pageNumber');
            if ($currentPage > ($lastPage = $this->postsByTag->lastPage()) && $currentPage > 1)
                return Redirect::to($this->currentPageUrl([$pageNumberParam => $lastPage]));
        }
    }

    public function getSiteBar($content, $type)
    {
        $content = (array)json_decode($content);
        if ($type == 1) {
            return BlogPost::getListPostSiteBar($content);
        }
        return BlogPost::getListPostMostView($content);
    }

    public function getLinkBanner($content)
    {
        $content = json_decode($content);
        if (!empty($content->link)) {
            return $content->link;
        }
        if (!empty($content->category)) {
            return BlogPost::getLinkPostWithCategory($content->category, $content->post_newest);
        }
        if (!empty($content->tag)) {
            return BlogPost::getLinkPostWithTag($content->tag, $content->post_newest);
        }
        return '#';
    }

    protected function prepareVars()
    {
        $this->pageParam = $this->page['pageParam'] = $this->paramName('pageNumber');
        $this->noPostsMessage = $this->page['noPostsMessage'] = $this->property('noPostsMessage');

        /*
         * Page links
         */
        $this->postPage = $this->page['postPage'] = $this->property('postPage');
        $this->categoryPage = $this->page['categoryPage'] = $this->property('categoryPage');
    }

    protected function getTagDefault() {
		$setting = new DisplaySetting();
		$displaySetting = $setting->first();
		$tagDefault = $this->loadTag();

		if ($tagDefault) {
			$tag = $tagDefault->id;
		} else if (empty($displaySetting->display_special_page) && !empty($displaySetting->default_tag)) {
			$tag = $displaySetting->default_tag;
		} else {
			$tag = null;
		}
		return $tag;
	}

    protected function listPosts()
    {
        $category = $this->category ? $this->category->id : null;
		$postPerPage = $this->getSettingPostPerPage() ? $this->getSettingPostPerPage() : $this->property('postsPerPage');

        /*
         * List all the posts, eager load their categories
         */
        $posts = BlogPost::with('categories')
            ->where('is_page', false)
            ->orderBy('published_at', 'desc')
            ->listFrontEnd([
            'page'       => $this->property('pageNumber'),
            'sort'       => $this->property('sortOrder'),
            'perPage'    => $postPerPage,
            'search'     => $this->property('search'),
            'category'   => $category,
            'exceptPost' => $this->property('exceptPost'),
			'tag'		 => $this->getTagDefault()
        ]);

        /*
         * Add a "url" helper attribute for linking to each post and category
         */
        $posts->each(function($post) {
            $post->setUrl($this->postPage, $this->controller);

            $post->categories()->each(function($category) {
                $category->setUrl($this->categoryPage, $this->controller);
            });
        });

        return $posts;
    }

    protected function loadTag() {
		$slug = $this->property('tagFilter');
		if (!$slug) {
			return null;
		}

		$tag = new BlogTag;
		$tag = $tag->isClassExtendedWith('RainLab.Translate.Behaviors.TranslatableModel')
			? $tag->transWhere('slug', $slug)
			: $tag->where('slug', $slug);

		$tag = $tag->first();
		return $tag ? $tag : null;
	}

    protected function loadCategory()
    {
        if (!$slug = $this->property('categoryFilter')) {
            return null;
        }

        $category = new BlogCategory;

        $category = $category->isClassExtendedWith('RainLab.Translate.Behaviors.TranslatableModel')
            ? $category->transWhere('slug', $slug)
            : $category->where('slug', $slug);

        $category = $category->first();

        return $category ? $category : null;
    }

	protected function getSettingPostPerPage() {
		$displaySetting = DisplaySetting::first();
		return $displaySetting ? $displaySetting->post_per_page : null;
	}
	/**
	 * Get list post for slide of top page
	 *
	 * @return mixed
	 */
	public function getPostForSlider() {
		return BlogPost::where('published', 1)
			->where('published_at', '<=', date('Y-m-d H:i'))
			->where('is_slide_show', 1)
            ->where('is_page', false)
			->orderby('published_at', 'desc')
			->get();
	}

	public function getPostByCountView() {
		return BlogPost::where('published', 1)
            ->where('is_page', false)
			->where('published_at', '<=', date('Y-m-d H:i'))
			->where('count_view', '>', 0)
			->orderBy('count_view', 'desc')
			->orderBy('published_at', 'desc')
			->take(5)
			->get();
	}

    protected function listPostsByCate()
    {
        $category = $this->category ? $this->category->id : null;
        $postPerPage = $this->getSettingPostPerPage() ? $this->getSettingPostPerPage() : $this->property('postsPerPage');

        /*
         * List all the posts, eager load their categories
         */
        $posts = BlogPost::with('categories')
            ->where('is_page', false)
            ->orderBy('published_at', 'desc')
            ->listFrontEnd([
            'page'       => $this->property('pageNumber'),
            'sort'       => $this->property('sortOrder'),
            'perPage'    => $postPerPage,
            'search'     => $this->property('search'),
            'category'   => $category,
            'exceptPost' => $this->property('exceptPost'),
        ]);

        /*
         * Add a "url" helper attribute for linking to each post and category
         */
        $posts->each(function($post) {
            $post->setUrl($this->postPage, $this->controller);

            $post->categories()->each(function($category) {
                $category->setUrl($this->categoryPage, $this->controller);
            });
        });

        return $posts;
    }

    protected function listPostsByTag()
    {
        $is_parent = $this->tag ? $this->tag->is_parent : null;
        if ($is_parent) {
            $tag_id = $this->tag->id;
            $children_tag_list = $this->tag->children_tag;
            $postPerPage = $this->getSettingPostPerPage() ? $this->getSettingPostPerPage() : $this->property('postsPerPage');

            $posts = BlogPost::where(function ($query) use ($children_tag_list, $tag_id, $postPerPage) {
                $query->where('parent_tag_list', 'LIKE', '%"' . $tag_id . '"%');
                foreach ($children_tag_list as $key => $value) {
                    $query->orWhere('children_tag_list', 'LIKE', '%"' . $value->children_tag_id . '"%');
                }
            })->where('is_page', false)
                ->orderBy('published_at', 'desc')
                ->listFrontEnd([
                'page'       => $this->property('pageNumber'),
                'sort'       => $this->property('sortOrder'),
                'perPage'    => $postPerPage,
                'search'     => $this->property('search'),
                'exceptPost' => $this->property('exceptPost'),
            ]);

            return $posts;
        } else {

            return $this->listPosts();
        }
    }

    /**
     * @param $post_id
     * @return string
     */
    public function getColorOfPost($post_id)
    {
        $color = 'grey';
        if ($post = BlogPost::find($post_id)) {
            if ($post->categories) {
                $color = $post->categories->color;
            } elseif ($post->parent_tag_list && $parent_tag = (new ContentTag())->getParentTagOfPost($post_id)) {
                foreach ($parent_tag as $tag) {
                    $color = $tag->tag_color;
                    break;
                }

            } elseif ($post->children_tag_list && $children_tag = (new ContentTag())->getChildrenTagOfPost($post_id)) {
                foreach ($children_tag as $tag) {
                    $color = $tag->tag_color;
                    break;
                }
            }
        }

        return $color;
    }

    /**
     * @param $post_id
     * @return string
     */
    public function getColorCategory($post_id)
    {
        $color = 'grey';
        if ($post = BlogPost::find($post_id)) {
            if ($post->categories) {
                $color = $post->categories->color;
            }
        }

        return $color;
    }

    /**
     * @param $post_id
     * @return string
     */
    public function getColorFirstTag($post_id)
    {
        $color = 'grey';
        if ($post = BlogPost::find($post_id)) {
            if ($post->parent_tag_list && $parent_tag = (new ContentTag())->getParentTagOfPost($post_id)) {
                foreach ($parent_tag as $tag) {
                    $color = $tag->tag_color;
                    break;
                }

            }
        }

        return $color;

    }

    public function getNameFirstTag($post_id)
    {
        $name = null;
        $post = BlogPost::find($post_id);
        if ($post->parent_tag_list) {
            $parent_tag = (new ContentTag())->getParentTagOfPost($post_id);
            foreach ($parent_tag as $tag) {
                $name = $tag->name;
                break;
            }
        }

        return $name;
    }

    /**
     * @param $post_id
     * @return null
     */
    public function getDisplayNameOfPost($post_id)
    {
        $name = null;
        $post = BlogPost::find($post_id);
        if ($post->categories) {
            $name = $post->categories->name;
        } elseif ($post->parent_tag_list) {
            $parent_tag = (new ContentTag())->getParentTagOfPost($post_id);
            foreach ($parent_tag as $tag) {
                $name = $tag->name;
                break;
            }
        } elseif ($post->children_tag_list) {
            $children_tag = (new ContentTag())->getChildrenTagOfPost($post_id);
            foreach ($children_tag as $tag) {
                $name = $tag->name;
                break;
            }
        }

        return $name;
    }

    public function getNameCategory($post_id)
    {
        $name = null;
        $post = BlogPost::find($post_id);
        if ($post->categories) {
            $name = $post->categories->name;
        }

        return $name;
    }

    public function getTagsByCategory() {

        $posts = $this->listPosts();
        $listidTag = [];
        foreach ($posts as $post){
            foreach (json_decode($post->parent_tag_list) as $tagId)
            {
                array_push($listidTag,$tagId);
            }
        }
        $listidTagSort = [];
        $count  = count($listidTag);
        for ($i=0 ; $i<$count ; $i++){
            if (!isset($listidTagSort[$listidTag[$i]])) {
                $listidTagSort[$listidTag[$i]] = 0;
            }
            $listidTagSort[$listidTag[$i]]++;
        }
        arsort($listidTagSort);
        $listIdCategorys = array_keys($listidTagSort);

        $result =  db::table('content_tag')->whereIn('id',$listIdCategorys)->get();
        $listCategory = [];
        foreach($result as $key => $listIdCategory){
            $listCategory[$listIdCategory->id] = $listIdCategory;
        }
        $dataReturn = [];
        foreach ($listIdCategorys as $key=>$listIdCategory){
            if (isset($listCategory[$listIdCategory]))
                array_push($dataReturn,$listCategory[$listIdCategory]);
        }

        return $dataReturn;
    }
}
