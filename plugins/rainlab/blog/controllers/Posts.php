<?php namespace RainLab\Blog\Controllers;

use Backend\Facades\BackendAuth;
use Flash;
use Redirect;
use BackendMenu;
use Backend\Classes\Controller;
use ApplicationException;
use RainLab\Blog\Models\Post;
use System\Classes\SettingsManager;
use Illuminate\Support\Facades\Input;
use File;
use Response;
use Backend;
use Db;

class Posts extends Controller
{
    public $postOfMine;
    public $listParentTag;
    public $listChildrenTag;
    public $is_create;
    public $parentTagListCurrent;
    public $childrenTagListCurrent;
    public $listAllTagOfPost;
    public $workflow_status;
    public $slug;
    public $listTagMenu;
    public $setting;

    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.ImportExportController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $importExportConfig = 'config_import_export.yaml';
    public $relationConfig;

    public $requiredPermissions = ['backend.blog.*'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('RainLab.Blog', 'blog', 'posts');
        $this->addJs('/plugins/rainlab/blog/assets/js/post/content_field.js');
    }

    public function index()
    {
        $this->vars['postsTotal'] = Post::count();
        $this->vars['postsPublished'] = Post::isPublished()->count();
        $this->vars['postsDrafts'] = $this->vars['postsTotal'] - $this->vars['postsPublished'];

        $this->asExtension('ListController')->index();
    }

    public function create()
    {
        BackendMenu::setContextSideMenu('new_post');

        $this->bodyClass = 'compact-container';
        $this->addCss('/plugins/rainlab/blog/assets/css/rainlab.blog-preview.css');
        $this->addJs('/plugins/rainlab/blog/assets/js/post-form.js');
        $this->addCss('/plugins/rainlab/blog/assets/css/custom.css');
        $this->addCss('/modules/backend/formwidgets/richeditor/assets/css/richeditor.css?v1');
        $this->addJs('/modules/backend/formwidgets/richeditor/assets/js/build-min.js?v1');
        $this->addJs('/modules/backend/formwidgets/richeditor/assets/vendor/froala/js/languages/ja.js');
        $this->addJs(Backend::skinAsset('assets/js/redips/redips-drag.js'));
        $this->addJs(Backend::skinAsset('assets/js/redips/redips-table-min.js'));
        $this->addJs(Backend::skinAsset('assets/js/redips/content-template.js'));
        $this->addCss(Backend::skinAsset('assets/css/template.css'));
        $this->addCss('https://use.fontawesome.com/releases/v5.1.1/css/all.css');
        $this->addJs('/plugins/rainlab/blog/assets/js/custom_form.js');
        $this->listParentTag = app('content.tag')->getTagList();
        $this->listTagMenu = app('content.menu')->getListMenuGlobal();
        $this->is_create = true;
        $this->slug = app('cms.post')->getSlug();
        $this->setting = app('backend.info')->getData();

        return $this->asExtension('FormController')->create();
    }

    public function update($recordId = null)
    {
        $this->bodyClass = 'compact-container';
        $this->addCss('/plugins/rainlab/blog/assets/css/rainlab.blog-preview.css');
        $this->addJs('/plugins/rainlab/blog/assets/js/post-form.js');
        $this->addCss('/plugins/rainlab/blog/assets/css/custom.css');
        $this->addCss('/modules/backend/formwidgets/richeditor/assets/css/richeditor.css?v1');
        $this->addJs('/modules/backend/formwidgets/richeditor/assets/js/build-min.js?v1');
        $this->addJs('/modules/backend/formwidgets/richeditor/assets/vendor/froala/js/languages/ja.js');
        $this->addJs(Backend::skinAsset('assets/js/redips/redips-drag.js'));
        $this->addJs(Backend::skinAsset('assets/js/redips/redips-table-min.js'));
        $this->addJs(Backend::skinAsset('assets/js/redips/content-template.js'));
        $this->addJs('/plugins/rainlab/blog/assets/js/custom_form.js');
        $this->addJs('https://cdnjs.cloudflare.com/ajax/libs/file-uploader/5.16.2/all.fine-uploader/all.fine-uploader.core.min.js');
        $this->addCss(Backend::skinAsset('assets/css/template.css'));
        $this->addCss('https://use.fontawesome.com/releases/v5.1.1/css/all.css');
        $this->checkPostOfMine($recordId);
        app('backend.post')->readPublic($recordId);
        $this->listTagMenu = app('content.menu')->getListMenuGlobal();
        $this->listParentTag = app('content.tag')->getParentTagOfPost($recordId);
        $this->parentTagListCurrent = app('content.tag')->getParentTaglistCurrent($recordId);
        $this->listAllTagOfPost = app('content.tag')->getAllTagOfPost($recordId);
        $this->workflow_status = app('backend.approve')->getWorkflowStatus($recordId);
        $this->setting = app('backend.info')->getData();

        return $this->asExtension('FormController')->update($recordId);
    }

    public function listExtendQuery($query)
    {
        if (!$this->user->hasAnyAccess(['backend.blog.others.*'])) {
            $query->where('user_id', $this->user->id);
        }
    }

    public function formExtendQuery($query)
    {
        if (!$this->user->hasAnyAccess(['backend.blog.others.*'])) {
            $query->where('user_id', $this->user->id);
        }
    }

    public function formExtendFieldsBefore($widget)
    {
        if (!$model = $widget->model) {
            return;
        }

        if ($model instanceof Post && $model->isClassExtendedWith('RainLab.Translate.Behaviors.TranslatableModel')) {
            $widget->secondaryTabs['fields']['content']['type'] = 'RainLab\Blog\FormWidgets\MLBlogMarkdown';
        }
    }

    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $postId) {
                if ((!$post = Post::find($postId)) || !$post->canEdit($this->user)) {
                    continue;
                }

                $post->delete();
            }

            Flash::success('Successfully deleted those posts.');
        }

        return $this->listRefresh();
    }

    /**
     * {@inheritDoc}
     */
    public function listInjectRowClass($record, $definition = null)
    {
        if (!$record->published) {
            return 'safe disabled';
        }
    }

    public function formBeforeCreate($model)
    {
        $model->user_id = $this->user->id;
    }

    public function onRefreshPreview()
    {
        $data = post('Post');

        $previewHtml = Post::formatHtml($data['content'], true);

        return [
            'preview' => $previewHtml
        ];
    }

    public function checkPostOfMine($recordId)
    {
        if (BackendAuth::getUser()->id == Post::find($recordId)->user_id)
        {
            $this->postOfMine = 1;
        }

    }

    public function formAfterUpdate($model)
    {
        if ($model->status == 2 && $model->post_reject == 1 && $model->owner_read_notify == 1) {
            db::table('rainlab_blog_posts')
                ->where('id', $model->id)
                ->update([
                    'post_reject' => 0,
                    'reviewer_read' => 0,
                    'owner_read_notify' => 0,
                    'reviewer_comment' => ''
                ]);
        }
    }

    public function uploadContentImage()
    {
        $file = Input::file('image');
        $name = explode('.', $file->getClientOriginalName())[0];
        $ext = $file->getClientOriginalExtension();
        $path = storage_path('app/media/uploaded-files/');
        $imageName = $this->setImageName($path, $name, $ext);

        if ($file->move($path,$imageName . '.' . $ext)) {
            $storagePath = '/storage/app/media/uploaded-files/';
            return Response::json(['status' => 'success', 'image' => $storagePath . $imageName . '.' . $ext]);
        }

        return Response::json(['status' => 'fail']);
    }

    public function uploadContentVideo()
    {
        $file = Input::file('video');
        $name = explode('.', $file->getClientOriginalName())[0];
        $ext = $file->getClientOriginalExtension();
        if ($ext != 'mp4' && $ext != 'MP4' && $ext != 'mov' && $ext != 'MOV') {
            return Response::json(['status' => 'fail', 'message' => 'mp4ファイルとmovファイルを選択してください。']);
        }
        $path = storage_path('app/media/uploaded-files/');
        $videoName = $this->setImageName($path, $name, $ext);
        if ($file->move($path,$videoName . '.' . $ext)) {
            $storagePath = '/storage/app/media/uploaded-files/';
            return Response::json(['status' => 'success', 'video' => $storagePath . $videoName . '.' . $ext]);
        }

        return Response::json(['status' => 'fail']);
    }

    private function setImageName($path, $name, $ext) {
        $filePath = $path .  $name . '.' . $ext;
        $newName = $name;
        $number = 1;
        while(File::exists($filePath)) {
            $newName = $name . '_' . $number;
            $filePath = $path . $newName . '.' . $ext;
            $number++;
        }

        return $newName;
    }

    public function getParentTagList($post_id)
    {
        return app('content.tag')->getParentTagOfPost($post_id);
    }

    public function getChildrenTagList($post_id)
    {
        return app('content.tag')->getChildrenTagOfPost($post_id);
    }
}
