<?php namespace RainLab\Blog\Controllers;


use Backend\Classes\Controller;
use Backend\Facades\Backend;
use Backend\Facades\BackendMenu;
use Illuminate\Support\Facades\Redirect;
use October\Rain\Exception\ValidationException as ValidationException;
use System\Classes\SettingsManager;

class Tag extends Controller
{
    public $parent_tag;
    public $relation_tag;
    public $parent_tag_current;
    public $detailTag;

    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class
    ];

    public $formConfig = 'config_form.yaml';

    public $listConfig = 'config_list.yaml';

    public $requiredPermissions = ['backend.blog.edit_tag'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('October.System', 'system', 'users');
        SettingsManager::setContext('October.System', 'blog_tags');
    }


    public function create()
    {
        return $this->asExtension('FormController')->create();
    }

    public function create_onSave()
    {
        $tag = post('Tag');
        $validator = app('content.tag')->validator($tag);
        if ($validator->fails()) {
            throw new ValidationException(['error' => $validator->messages()->first()]);
        } else {
            $import = app('content.tag')->insert($tag);
            if ($import) {
                return Redirect::to(Backend::url('rainlab/blog/tag'))
                    ->withSuccess(e(trans('system::lang.saved.success')));
            }
        }
    }

    public function update($recordId, $context = null)
    {

        $this->detailTag = app('content.tag')->detailTag($recordId);
        if($this->detailTag == null){
            return Redirect::to(Backend::url('rainlab/blog/tag'));
        }
        return $this->asExtension('FormController')->update($recordId, $context);
    }

    public function update_onSave($recordId)
    {
        $tag = post('Tag');
        $validator = app('content.tag')->validatorUpdate($tag, $recordId);
        if ($validator->fails()) {
            throw new ValidationException(['error' => $validator->messages()->first()]);
        } else {
            $update = app('content.tag')->update($tag, $recordId);
            if ($update) {
                return Redirect::to(Backend::url('rainlab/blog/tag'))
                    ->withSuccess(e(trans('rainlab.blog::lang.tag.edit_success')));
            }
        }
    }

    public function update_onDelete($recordId)
    {
        if (app('content.tag')->deleteTag($recordId)) {
            return Redirect::to(Backend::url('rainlab/blog/tag'))
                ->withSuccess(e(trans('rainlab.blog::lang.tag.delete_success')));
        }
    }
}