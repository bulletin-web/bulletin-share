<?php namespace RainLab\Blog\Components;

use Db;
use App;
use RainLab\Blog\Models\Category;
use RainLab\Blog\Models\Tag;
use Request;
use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use RainLab\Blog\Models\Category as BlogCategory;
use RainLab\Blog\Models\Post;

class Categories extends ComponentBase
{
    /**
     * @var Collection A collection of categories to display
     */
    public $categories;

    /**
     * @var string Reference to the page name for linking to categories.
     */
    public $categoryPage;

    /**
     * @var string Reference to the current category slug.
     */
    public $currentCategorySlug;

    public function componentDetails()
    {
        return [
            'name'        => 'rainlab.blog::lang.settings.category_title',
            'description' => 'rainlab.blog::lang.settings.category_description'
        ];
    }

    public function defineProperties()
    {
        return [
            'slug' => [
                'title'       => 'rainlab.blog::lang.settings.category_slug',
                'description' => 'rainlab.blog::lang.settings.category_slug_description',
                'default'     => '{{ :slug }}',
                'type'        => 'string'
            ],
            'displayEmpty' => [
                'title'       => 'rainlab.blog::lang.settings.category_display_empty',
                'description' => 'rainlab.blog::lang.settings.category_display_empty_description',
                'type'        => 'checkbox',
                'default'     => 0
            ],
            'categoryPage' => [
                'title'       => 'rainlab.blog::lang.settings.category_page',
                'description' => 'rainlab.blog::lang.settings.category_page_description',
                'type'        => 'dropdown',
                'default'     => 'blog/category',
                'group'       => 'Links',
            ],
        ];
    }

    public function getCategoryPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function onRun()
    {
        $this->currentCategorySlug = $this->page['currentCategorySlug'] = $this->property('slug');
        $this->categoryPage = $this->page['categoryPage'] = $this->property('categoryPage');
        $this->categories = $this->page['categories'] = $this->loadCategories();
    }

    protected function loadCategories()
    {
        $categories = BlogCategory::orderBy('name');
        if (!$this->property('displayEmpty')) {
            $categories->whereExists(function($query) {
                $prefix = Db::getTablePrefix();

                $query
                    ->select(Db::raw(1))
                    ->from('rainlab_blog_posts_categories')
                    ->join('rainlab_blog_posts', 'rainlab_blog_posts.id', '=', 'rainlab_blog_posts_categories.post_id')
                    ->whereNotNull('rainlab_blog_posts.published')
                    ->whereNotNull('rainlab_blog_posts.is_page')
                    ->where('rainlab_blog_posts.published', '=', 1)
                    ->where('rainlab_blog_posts.is_page', '=', 1)
                    ->whereRaw($prefix.'rainlab_blog_categories.id = '.$prefix.'rainlab_blog_posts_categories.category_id')
                ;
            });
        }

        $categories = $categories->getNested();

        /*
         * Add a "url" helper attribute for linking to each category
         */
        return $this->linkCategories($categories);
    }

    protected function linkCategories($categories)
    {
        return $categories->each(function($category) {
            $category->setUrl($this->categoryPage, $this->controller);

            if ($category->children) {
                $this->linkCategories($category->children);
            }
        });
    }

	/**
	 * Get list category by limit
	 *
	 * @param int $limit number item display
	 *
	 * @return mixed
	 */
	public function getLimitCategory($limit) {
    	return Category::orderBy('id', 'desc')
			->take($limit)
			->get();
	}

	public function getTagsByCategory($categoryId) {
		$posts = Post::where('category_id', $categoryId)
                 ->where('published',1)
                 ->get();
		$listidTag = [];
		foreach ($posts as $post){
            if (empty(json_decode($post->parent_tag_list))) {
                continue;
            }
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

        $result = db::table('content_tag')->whereIn('id',$listIdCategorys)->get();
        $listCategory = [];
        foreach($result as $key => $listIdCategory){
            $listCategory[$listIdCategory->id] = $listIdCategory;
        }
        $dataReturn = [];
        foreach ($listIdCategorys as $key=>$listIdCategory){
            array_push($dataReturn,$listCategory[$listIdCategory]);
        }

        return $dataReturn;
	}
	public function getTotalPostbyCategory($categoryId){
        return Post::where('category_id', $categoryId)->count();
    }
}
