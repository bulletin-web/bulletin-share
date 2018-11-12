<?php namespace RainLab\Blog\Models;

use App;
use Backend\Models\User;
use Backend\Models\WorkFlow;
use BackendAuth;
use Carbon\Carbon;
use Cms\Classes\Page as CmsPage;
use Cms\Classes\Theme;
use Html;
use Illuminate\Support\Facades\Session;
use Lang;
use Markdown;
use Model;
use RainLab\Blog\Classes\TagProcessor;
use Str;
use System\Models\File;
use Url;
use ValidationException;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'rainlab_blog_posts';
    public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];

    /*
     * Validation
     */
    public $rules = [
        'title' => 'required',
        'slug' => ['required', 'regex:/^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i', 'unique:rainlab_blog_posts'],
        'content' => 'required',
        'workflow_id' => 'required_if:action,==,2',
        'published_at' => 'required_if:action,==,4',
        'excerpt' => '',
    ];

    public $customMessages = [
        'workflow_id.required_if' => 'レビュアーは、必ず指定してください。',
        'published_at.required_if'=>'投稿の公開日を指定してください。'
    ];

    public $attributeNames = [
        'workflow_id' => 'レビュアー',
        'title' => 'タイトル',
        'slug' => 'スラッグ',
        'content' => '内容',
        'categories' => 'カテゴリ',
        'tags' => 'タグ',
        'featured_image' => 'アイキャッチ画像',
    ];
    /**
     * @var array Attributes that support translation, if available.
     */
    public $translatable = [
        'title',
        'content',
        'content_html',
        'excerpt',
        ['slug', 'index' => true]
    ];

    /**
     * The attributes that should be mutated to dates.
     * @var array
     */
    protected $dates = ['published_at'];

    /**
     * The attributes on which the post list can be ordered
     * @var array
     */
    public static $allowedSortingOptions = [
        'title asc' => 'Title (ascending)',
        'title desc' => 'Title (descending)',
        'created_at asc' => 'Created (ascending)',
        'created_at desc' => 'Created (descending)',
        'updated_at asc' => 'Updated (ascending)',
        'updated_at desc' => 'Updated (descending)',
        'random' => 'Random'
    ];

    /*
     * Relations
     */
    public $belongsTo = [
        'user' => ['Backend\Models\User'],
        'categories' => ['RainLab\Blog\Models\Category', 'key' => 'category_id'],
        'workflow' => ['Backend\Models\WorkFlow', 'key' => 'workflow_id']
    ];

    public $belongsToMany = [
        'tags' => [
            'RainLab\Blog\Models\Tag',
            'table' => 'rainlab_blog_posts_tags',
            'order' => 'name',
        ],
    ];

    public $hasMany = [
        'comments' => [
            'RainLab\Blog\Models\Comment',
            'key' => 'post_id',
            'order' => 'created_at < > DESC'
        ],
        'postTag' => [
            'RainLab\Blog\Models\PostTag',
            'key' => 'post_id'
        ]
    ];

    public $attachMany = [
        'featured_images' => ['System\Models\File', 'order' => 'sort_order'],
        'content_images' => ['System\Models\File']
    ];

    public $attachOne = [
        'featured_image' => ['System\Models\File']
    ];

    /**
     * @var array The accessors to append to the model's array form.
     */
    protected $appends = ['summary', 'has_summary'];

    public $preview = null;

    /**
     * Adds the post to the given tag
     *
     * @param Tag $tag
     *
     * @return bool
     */
    public function addTag($tag)
    {
        if (!$this->inTag($tag)) {
            $this->tags()->attach($tag);
            $this->reloadRelations('tags');
        }

        return true;
    }

    /**
     * See if the post is in the given tag.
     *
     * @param Tag $tag
     *
     * @return bool
     */
    public function inTag($tag)
    {
        foreach ($this->getTags() as $_tag) {
            if ($_tag->getKey() == $tag->getKey()) {
                return true;
            }
        }

        return false;
    }

    /**
     * Returns an array of tags which the given user belongs to.
     *
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Limit visibility of the published-button
     * @return void
     */
    public function filterFields($fields, $context = null)
    {
        if (!isset($fields->published, $fields->published_at)) {
            return;
        }

        $user = BackendAuth::getUser();

        if (!$user->hasAnyAccess(['rainlab.blog.access_publish'])) {
            $fields->published->hidden = true;
            $fields->published_at->hidden = true;
        } else {
            $fields->published->hidden = false;
            $fields->published_at->hidden = false;
        }
    }

    public function afterValidate()
    {
        if ($this->publish_type == 2 && !$this->published_at) {
            throw new ValidationException([
               'published_at' => Lang::get('rainlab.blog::lang.post.published_validation')
            ]);
        }
    }

    public function beforeDelete()
    {
        Comment::where('post_id', $this->id)->delete();
    }

    public function beforeSave()
    {
        $this->title = strip_tags($this->title);
        $this->content_html = $this->content;
        if (!$this->category_id) {
            $this->category_id = null;
        }

        if (!$this->page && $this->approved && $this->status == 4) {
            if ($this->action) {

                if (post('Post')['action'] != "3" && post('Post')['action'] != "4") {
                    throw new ValidationException([
                        'action' => Lang::get('rainlab.blog::lang.post.action_validation_is_approve')
                    ]);
                }
            }
        }

        if (!post('Post')['featured_image']) {
            throw new ValidationException([
                'featured_image' => 'アイキャッチ画像は、必ず指定してください。'
            ]);
        }
    }

    public function beforeCreate()
    {
        if ($this->action) {
            if ($this->action != 1
                && $this->action != 2) {
                throw new ValidationException([
                    'action' => Lang::get('rainlab.blog::lang.post.action_validation')
                ]);
            }
        }

        if ($this->is_page) {
            $this->published = true;
            $this->reviewer_id = false;
            $this->status = 4;
            $this->workflow_id = false;
            $this->action = false;
        } elseif ($this->action == 2) {
            $this->published = false;
            $this->status = 2;
            $this->reviewer_id = app('backend.approve')
                ->setReviewerId($this->workflow_id);
        } else {
            $this->published = false;
            $this->action = true;
            $this->reviewer_id = false;
            $this->status = true;
            $this->workflow_id = false;
        }

        if (isset(post('Post')['parent_tag_list'])) {
            $parent_tag_list = [];
            foreach (post('Post')['parent_tag_list'] as $value) {
                $parent_tag_list[$value] = $value;
            }
            $this->parent_tag_list = json_encode($parent_tag_list);
        }

        if (isset(post('Post')['children_tag_list'])) {
            $children_tag_list = [];
            foreach (post('Post')['children_tag_list'] as $value) {
                $children_tag_list[$value] = $value;
            }
            $this->children_tag_list = json_encode($children_tag_list);
        }
    }

    public function beforeUpdate()
    {
        $post = $this->find($this->id);
        if ($this->is_page) {
            $this->published = true;
            $this->reviewer_id = false;
            $this->status = 5;
            $this->workflow_id = false;
            $this->action = false;
        } else {
            if (!$this->approved) {
                if ($this->action && $this->action != 1 && $this->action != 2) {
                    throw new ValidationException([
                        'action' => Lang::get('rainlab.blog::lang.post.action_validation')
                    ]);
                }
                if ($this->action == 2) {
                    $this->published = false;
                    $this->status = 2;
                    $this->reviewer_id = app('backend.approve')
                        ->setReviewerId($this->workflow_id);
                } else {
                    $this->published = false;
                    $this->action = true;
                    $this->reviewer_id = false;
                    $this->status = true;
                    $this->workflow_id = false;
                }
            } else {
                if ($this->action == 1 || $this->action == 5) {
                    $this->published = false;
                    $this->status = 8;
                }
            }
            if ($this->content_json != post('Post')['content_json']) {
                if($this->approved){
                    $this->published = false;
                    $this->count_approve = 0;
                    $this->reviewer_id = 0;
                    $this->status = 1;
                    $this->action = 1;
                    $this->approved = 0;
                    $this->publish_read_post = 0;
                    $this->workflow_id = 0;
                }
                if($this->status == 7){
                    if(post('Post')['content_json'] == 2) {
                        $this->published = false;
                        $this->status = 2;
                        $this->reviewer_id = app('backend.approve')
                            ->setReviewerId($this->workflow_id);
                    }

                }




            } else {
                if ($this->status == 8 && $this->approved) {
                    if ($this->action == 3) {
                        $this->published = 1;
                        $this->status = 5 ;
                    }
                    if ($this->action == 4) {
                        $this->published = false;
                        $this->status = 6;
                    }
                } else {
                    if (post('Post')['action'] == 3) {
                        $this->published = 1;
                        $this->status = 5 ;
                        $this->published_at = date(now());
                        if ($post->published_at) {
                            $this->published_at = $post->published_at;
                        }
                    }
                    if (post('Post')['action'] == 4) {
                        $this->status = 6 ;
                        $this->action = post('Post')['action'] ;
                    }
                }
            }
        }

        if (empty(post('Post')['action'])) {
            $this->action = false;
        }

        if (isset(post('Post')['parent_tag_list'])) {
            if (count(post('Post')['parent_tag_list']) == 1) {
                $this->parent_tag_list = null;
            } else {
                $parent_tag_input = post('Post')['parent_tag_list'];
                foreach ($parent_tag_input as $key => $tag) {
                    if ($tag == 0) {
                        unset($parent_tag_input[$key]);
                    }
                }
                $parent_tag_list = [];
                foreach ($parent_tag_input as $value) {
                    $parent_tag_list[$value] = $value;
                }
                $this->parent_tag_list = json_encode($parent_tag_list);
            }
        }

        if (isset(post('Post')['children_tag_list'])) {
            if (count(post('Post')['children_tag_list']) == 1) {
                $this->children_tag_list = null;
            } else {
                $children_tag_input = post('Post')['children_tag_list'];
                foreach ($children_tag_input as $key => $tag) {
                    if ($tag == 0) {
                        unset($children_tag_input[$key]);
                    }
                }
                $children_tag_list = [];
                foreach ($children_tag_input as $value) {
                    $children_tag_list[$value] = $value;
                }
                $this->children_tag_list = json_encode($children_tag_list);
            }
        }
    }


    public function afterSave()
    {
        $file = File::where('attachment_id', $this->id);
        if (!$file->exists() || $file->first()->file_name != $this->featured_image) {
            $fileName = post('Post')['featured_image'];
            $hash = md5(post('Post')['featured_image'] . '!' . time());
            $path1 = substr($hash,0,3);
            $path2 = substr($hash,3,3);
            $path3 = substr($hash,6,3);

            $pathStoreMedia = storage_path('app/media');

            $pathStoreUpload = storage_path('app/uploads/public');

            $ext = pathinfo($pathStoreMedia . $fileName, PATHINFO_EXTENSION);

            if (!is_dir($pathStoreUpload . '/' . $path1 . '/' . $path2 . '/' . $path3)) {
                mkdir($pathStoreUpload . '/' . $path1, 0755);
                mkdir($pathStoreUpload . '/' . $path1 . '/' . $path2, 0755);
                mkdir($pathStoreUpload . '/' . $path1 . '/' . $path2 . '/' . $path3, 0755);
            }

            copy($pathStoreMedia . $fileName, $pathStoreUpload . '/' . $path1 . '/' . $path2 . '/' . $path3 . '/' . $hash . '.' . $ext);

            File::updateOrCreate([
                'attachment_id' => $this->id
            ],[
                'disk_name' => $hash . '.' . $ext,
                'file_name' => post('Post')['featured_image'],
                'file_size' => '12345',
                'content_type' => 'image/jpeg',
                'field' => 'featured_image',
                'attachment_id' => $this->id,
                'attachment_type' => 'RainLab\Blog\Models\Post',
                'is_public' => 1
            ]);
        }
        db::table('rainlab_blog_posts')
            ->where('id', $this->id)
            ->update(['content_json'=>post('Post')['content_json']]);

        PostTag::where('tag_id', false)->delete();
    }

    /**
     * Sets the "url" attribute with a URL to this object
     * @param string $pageName
     * @param Cms\Classes\Controller $controller
     */
    public function setUrl($pageName, $controller)
    {
        $params = [
            'id'   => $this->id,
            'slug' => $this->slug,
        ];

        if (array_key_exists('categories', $this->getRelations())) {
            $params['category'] = $this->categories()->count() ? $this->categories()->first()->slug : null;
        }

        //expose published year, month and day as URL parameters
        if ($this->published) {
            $params['year'] = $this->published_at->format('Y');
            $params['month'] = $this->published_at->format('m');
            $params['day'] = $this->published_at->format('d');
        }

        return $this->url = $controller->pageUrl($pageName, $params);
    }

    /**
     * Used to test if a certain user has permission to edit post,
     * returns TRUE if the user is the owner or has other posts access.
     * @param User $user
     * @return bool
     */
    public function canEdit(User $user)
    {
        return ($this->user_id == $user->id) || $user->hasAnyAccess(['backend.blog.others.*']);
    }

    public static function formatHtml($input, $preview = false)
    {
        $result = Markdown::parse(trim($input));

        if ($preview) {
            $result = str_replace('<pre>', '<pre class="prettyprint">', $result);
        }

        $result = TagProcessor::instance()->processTags($result, $preview);

        return $result;
    }

    //
    // Scopes
    //

    public function scopeIsPublished($query)
    {
        return $query
            ->whereNotNull('published')
            ->where('published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<', Carbon::now())
        ;
    }

    /**
     * Lists posts for the front end
     * @param  array $options Display options
     * @return self
     */
    public function scopeListFrontEnd($query, $options)
    {
        /*
         * Default options
         */
        extract(array_merge([
            'page'       => 1,
            'perPage'    => 30,
            'sort'       => 'created_at',
            'categories' => null,
            'category'   => null,
            'search'     => '',
            'published'  => true,
            'exceptPost' => null,
            'tag'         => null
        ], $options));

        $searchableFields = ['title', 'slug', 'excerpt', 'content'];

        if ($published) {
            $query->isPublished();
        }

        /*
         * Ignore a post
         */
        if ($exceptPost) {
            if (is_numeric($exceptPost)) {
                $query->where('id', '<>', $exceptPost);
            } else {
                $query->where('slug', '<>', $exceptPost);
            }
        }

        /*
         * Sorting
         */
        if (!is_array($sort)) {
            $sort = [$sort];
        }

        foreach ($sort as $_sort) {
            if (in_array($_sort, array_keys(self::$allowedSortingOptions))) {
                $parts = explode(' ', $_sort);
                if (count($parts) < 2) {
                    array_push($parts, 'desc');
                }
                list($sortField, $sortDirection) = $parts;
                if ($sortField == 'random') {
                    $sortField = Db::raw('RAND()');
                }
                $query->orderBy($sortField, $sortDirection);
            }
        }

        /*
         * Search
         */
        $search = trim($search);
        if (strlen($search)) {
            $query->searchWhere($search, $searchableFields);
        }

        /*
         * Categories
         */
        if ($categories !== null) {
            if (!is_array($categories)) {
                $categories = [$categories];
            }
            $query->whereHas('categories', function ($q) use ($categories) {
                $q->whereIn('id', $categories);
            });
        }

        /*
         * Category, including children
         */
        if ($category !== null) {
            $category = Category::find($category);

            $categories = $category->getAllChildrenAndSelf()->lists('id');
            $query->whereHas('categories', function ($q) use ($categories) {
                $q->whereIn('id', $categories);
            });
        }

        if ($tag !== null) {
            $query->join('rainlab_blog_posts_tags', 'rainlab_blog_posts.id', '=', 'rainlab_blog_posts_tags.post_id')
                ->where('rainlab_blog_posts_tags.tag_id', $tag);
        }

        return $query->paginate($perPage, $page);
    }

    /**
     * Allows filtering for specifc categories
     * @param  Illuminate\Query\Builder  $query      QueryBuilder
     * @param  array                     $categories List of category ids
     * @return Illuminate\Query\Builder              QueryBuilder
     */
    public function scopeFilterCategories($query, $categories)
    {
        return $query->whereHas('categories', function ($q) use ($categories) {
            $q->whereIn('id', $categories);
        });
    }

    //
    // Summary / Excerpt
    //

    /**
     * Used by "has_summary", returns true if this post uses a summary (more tag)
     * @return boolean
     */
    public function getHasSummaryAttribute()
    {
        $more = '<!-- more -->';

        return (
            !!strlen(trim($this->excerpt)) ||
            strpos($this->content_html, $more) !== false ||
            strlen(Html::strip($this->content_html)) > 600
        );
    }

    /**
     * Used by "summary", if no excerpt is provided, generate one from the content.
     * Returns the HTML content before the <!-- more --> tag or a limited 600
     * character version.
     *
     * @return string
     */
    public function getSummaryAttribute()
    {
        $excerpt = $this->excerpt;
        if (strlen(trim($excerpt))) {
            return $excerpt;
        }

        $more = '<!-- more -->';
        if (strpos($this->content_html, $more) !== false) {
            $parts = explode($more, $this->content_html);
            return array_get($parts, 0);
        }

        return Html::limit($this->content_html, 600);
    }

    //
    // Next / Previous
    //

    /**
     * Returns the next post, if available.
     * @return self
     */
    public function nextPost()
    {
        return self::isPublished()
            ->where('id', '>', $this->id)
            ->orderBy('id', 'asc')
            ->first()
        ;
    }

    /**
     * Returns the previous post, if available.
     * @return self
     */
    public function previousPost()
    {
        return self::isPublished()
            ->where('id', '<', $this->id)
            ->orderBy('id', 'desc')
            ->first()
        ;
    }

    //
    // Menu helpers
    //

    /**
     * Handler for the pages.menuitem.getTypeInfo event.
     * Returns a menu item type information. The type information is returned as array
     * with the following elements:
     * - references - a list of the item type reference options. The options are returned in the
     *   ["key"] => "title" format for options that don't have sub-options, and in the format
     *   ["key"] => ["title"=>"Option title", "items"=>[...]] for options that have sub-options. Optional,
     *   required only if the menu item type requires references.
     * - nesting - Boolean value indicating whether the item type supports nested items. Optional,
     *   false if omitted.
     * - dynamicItems - Boolean value indicating whether the item type could generate new menu items.
     *   Optional, false if omitted.
     * - cmsPages - a list of CMS pages (objects of the Cms\Classes\Page class), if the item type requires a CMS page reference to
     *   resolve the item URL.
     * @param string $type Specifies the menu item type
     * @return array Returns an array
     */
    public static function getMenuTypeInfo($type)
    {
        $result = [];

        if ($type == 'blog-post') {
            $references = [];
            $posts = self::orderBy('title')->get();
            foreach ($posts as $post) {
                $references[$post->id] = $post->title;
            }

            $result = [
                'references'   => $references,
                'nesting'      => false,
                'dynamicItems' => false
            ];
        }

        if ($type == 'all-blog-posts') {
            $result = [
                'dynamicItems' => true
            ];
        }

        if ($result) {
            $theme = Theme::getActiveTheme();

            $pages = CmsPage::listInTheme($theme, true);
            $cmsPages = [];

            foreach ($pages as $page) {
                if (!$page->hasComponent('blogPost')) {
                    continue;
                }

                /*
                 * Component must use a categoryPage filter with a routing parameter and post slug
                 * eg: categoryPage = "{{ :somevalue }}", slug = "{{ :somevalue }}"
                 */
                $properties = $page->getComponentProperties('blogPost');
                if (!isset($properties['categoryPage']) || !preg_match('/{{\s*:/', $properties['slug'])) {
                    continue;
                }

                $cmsPages[] = $page;
            }

            $result['cmsPages'] = $cmsPages;
        }

        return $result;
    }

    /**
     * Handler for the pages.menuitem.resolveItem event.
     * Returns information about a menu item. The result is an array
     * with the following keys:
     * - url - the menu item URL. Not required for menu item types that return all available records.
     *   The URL should be returned relative to the website root and include the subdirectory, if any.
     *   Use the Url::to() helper to generate the URLs.
     * - isActive - determines whether the menu item is active. Not required for menu item types that
     *   return all available records.
     * - items - an array of arrays with the same keys (url, isActive, items) + the title key.
     *   The items array should be added only if the $item's $nesting property value is TRUE.
     * @param \RainLab\Pages\Classes\MenuItem $item Specifies the menu item.
     * @param \Cms\Classes\Theme $theme Specifies the current theme.
     * @param string $url Specifies the current page URL, normalized, in lower case
     * The URL is specified relative to the website root, it includes the subdirectory name, if any.
     * @return mixed Returns an array. Returns null if the item cannot be resolved.
     */
    public static function resolveMenuItem($item, $url, $theme)
    {
        $result = null;

        if ($item->type == 'blog-post') {
            if (!$item->reference || !$item->cmsPage) {
                return;
            }

            $category = self::find($item->reference);
            if (!$category) {
                return;
            }

            $pageUrl = self::getPostPageUrl($item->cmsPage, $category, $theme);
            if (!$pageUrl) {
                return;
            }

            $pageUrl = Url::to($pageUrl);

            $result = [];
            $result['url'] = $pageUrl;
            $result['isActive'] = $pageUrl == $url;
            $result['mtime'] = $category->updated_at;
        } elseif ($item->type == 'all-blog-posts') {
            $result = [
                'items' => []
            ];

            $posts = self::orderBy('title')->get();
            foreach ($posts as $post) {
                $postItem = [
                    'title' => $post->title,
                    'url'   => self::getPostPageUrl($item->cmsPage, $post, $theme),
                    'mtime' => $post->updated_at,
                ];

                $postItem['isActive'] = $postItem['url'] == $url;

                $result['items'][] = $postItem;
            }
        }

        return $result;
    }

    /**
     * Returns URL of a post page.
     */
    protected static function getPostPageUrl($pageCode, $category, $theme)
    {
        $page = CmsPage::loadCached($theme, $pageCode);
        if (!$page) {
            return;
        }

        $properties = $page->getComponentProperties('blogPost');
        if (!isset($properties['slug'])) {
            return;
        }

        /*
         * Extract the routing parameter name from the category filter
         * eg: {{ :someRouteParam }}
         */
        if (!preg_match('/^\{\{([^\}]+)\}\}$/', $properties['slug'], $matches)) {
            return;
        }

        $paramName = substr(trim($matches[1]), 1);
        $url = CmsPage::url($page->getBaseFileName(), [$paramName => $category->slug]);

        return $url;
    }

    public function getTagsOptions()
    {
        return Tag::where('category_id', '=', $this->category_id)->lists('name', 'id');
    }

    public function getStatusOptions()
    {
        return [
            '1' => '下書き',
            '2' => '承認待ち',
            '3' => '承認中',
            '4' => '承認済み',
            '5' => '公開中',
            '6' => '予約公開',
            '7' => '承認却下',
            '8' => '公開中止'
        ];
    }

    public function getPublishTypeOptions()
    {
        return ['1' => '即時', '2' => '公開日'];
    }

    public function getHasCommentOptions()
    {
        return ['1' => '許可', '0' => '不可'];
    }

    public function getWorkflowIdOptions()
    {
        return WorkFlow::all()->lists('name', 'id');
//        return User::whereHas('role', function ($query) {
//            $query->where('permissions', 'LIKE', '%backend.blog.publish_post%');
//        })->where('id', '!=', BackendAuth::getUser()->id)->orWhere('is_superuser', '1')->get()->lists('full_name', 'id');
    }
    public function getActionOptions()
    {
        $optionsRule =[ 1 => '下書にする',
                        2  => '承認依頼'
        ];
        $roles = User::find(BackendAuth::getUser()->id)->role->permissions;
        foreach ($roles as $key => $role) {
            if ($key == 'backend.blog.public_stop') {
                $optionsRule[5] = '公開中止';
            }
            if($key == 'backend.blog.publish_post'){
                $optionsRule[3]  = '即時公開';
                $optionsRule[4] = '予約公開';

            }
        }
        if($this->status == 5){
            unset($optionsRule[2]);
            unset($optionsRule[3]);
            unset($optionsRule[4]);
        }
        return $optionsRule;
    }

    public function getStatusesAttribute()
    {
        $value = array_get($this->attributes, 'status');
        return array_get($this->getStatusOptions(), $value);
    }

    public function scopeCountViewOfPost()
    {
        if (!Session::has('post_' . $this->id)) {
            Session::put('post_' . $this->id, csrf_token());
            return self::increment('count_view');
        }
    }

    public function getListTag()
    {
        if ($this->categories) {
            return $this->categories->tags;
        }

        return null;
    }

    public function generateListTag($tags, $listChoice, $parent_id = 0, $limit = 0)
    {
        $listChoice = $listChoice;
        if ($limit > 1000) {
            return '';
        }
        $tree = '';
        $tree = '<ul>';
        foreach ($tags as $key => $tag) {
            $checked = in_array($tag->id, $listChoice) ? 'checked' : '';
            $count = $key + 1;
            if ($tag->parent_tag_id == $parent_id) {
                $tree .= '<li class="custom-checkbox">';
                $tree .= '<input type="checkbox" id="checkbox_Form-field-Post-tags_'.$count.'" name="Post[tags][] "'.$checked.' value="'.$tag->id.'">
                            <label for="checkbox_Form-field-Post-tags_'.$count.'">'.$tag->name.'</label>';
                $tree .= $this->generateListTag($tags, $listChoice, $tag->id, $limit++);
                $tree .= '</li>';
            }
        }
        $tree .= '</ul>';
        return $tree;
    }

    public function getCategoryIdOptions()
    {
        return Category::all()->lists('name', 'id');
//        $categories = [];
//        if ($cate = Category::all()) {
//            foreach ($cate as $category) {
//                $categories[$category->id] = $category->name;
//            }
//        }
//        return $categories;
    }

    public static function getListPost()
    {
        return Post::select('id', 'title')
            ->where('published', true)
            ->where('is_page', false)
            ->get();
    }

    public static function getListPostWithArray($arr)
    {
        return Post::select('id', 'title')
            ->where('published', true)
            ->where('is_page', false)
            ->whereIn('id', $arr)
            ->get();
    }

    public static function getListPostCurrent($arr)
    {
        return Post::select('id', 'title')
            ->where('published', true)
            ->where('is_page', false)
            ->whereNotIn('id', $arr)
            ->get();
    }

    public static function getListPostSiteBar($arr)
    {
        $str = '"';
        foreach ($arr as $value) {
            $str .= $value.',';
        }
        $str .= '"';
        return Post::select('id', 'title', 'slug')
            ->orderByRaw('FIND_IN_SET(id, '. $str .')')
            ->where('published', true)
            ->where('is_page', false)
            ->whereIn('id', $arr)
            ->get();
    }

    public static function getListPostMostView($content)
    {
        $selecter = ['id', 'title', 'slug'];
        if ($content['view'] == 1) {
            array_push($selecter, 'count_view');
        }
        return Post::select($selecter)
            ->orderBy('count_view', 'desc')
            ->where('published', true)
            ->where('is_page', false)
            ->limit($content['limit'])
            ->get();
    }

    public static function getLinkPostWithCategory($category_id, $post_newest)
    {
        if ($post_newest == 1) {
            $post = Post::where('category_id', $category_id)
                ->select('id', 'slug')
                ->where('published', true)
                ->where('is_page', false)
                ->orderBy('published_at', 'desc')
                ->first();
            if ($post) {
                return '/blog/post/'.$post->id;
            }
        }
        $category = Category::find($category_id);
        if ($category) {
            return '/blog/category/'.$category->slug;
        }
        return '#';
    }

    public static function getLinkPostWithTag($tag_id, $post_newest)
    {
        if ($post_newest == 1) {
            $post = Post::where('parent_tag_list', 'like', '%'.$tag_id.'%')
                ->select('id', 'slug')
                ->where('published', true)
                ->where('is_page', false)
                ->orderBy('published_at', 'desc')
                ->first();
            if ($post) {
                return '/blog/post/'.$post->id;
            }
        }
        $tag = Tag::find($tag_id);
        if ($tag) {
            return '/blog/tags/'.$tag->slug;
        }
        return '#';
    }
}
