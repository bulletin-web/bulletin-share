<?php
/**
 * Created by PhpStorm.
 * User: canhph
 * Date: 7/19/18
 * Time: 10:59 AM
 */
namespace Backend\Controllers;

use Backend\Classes\Controller;
use Backend\Facades\BackendMenu;
use October\Rain\Exception\ValidationException as ValidationException;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use RainLab\Blog\Models\Category;
use RainLab\Blog\Models\Tag;
use System\Classes\SettingsManager;

class Sitebar extends Controller
{

    public $posts;

    public $listRanking;

    public $listCurrent;

    public $post;

    public $rankPost;

    public $category;

    public $tag;
    /**
     * @var array Extensions implemented by this controller.
     */
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class
    ];

    /**
     * @var string FormController` configuration.
     */
    public $formConfig = 'config_form.yaml';

    /**
     * @var string ListController` configuration.
     */
    public $listConfig = 'config_list.yaml';

    /**
     * Menu constructor.
     */
    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('October.System', 'system', 'users');
        SettingsManager::setContext('October.System', 'sitebar');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function setType()
    {
        $sitebar_type = Request::get('sitebar_type');
        if (in_array($sitebar_type, [1,2,3,4])) {
            Session::put('sitebar_type', $sitebar_type);
            return redirect(url('backend/backend/sitebar/create'));
        }
        return redirect(url('/backend/backend/sitebar'));
    }

    public function create()
    {
        if (Session::has('sitebar_type')) {
            $this->category = Category::all('id', 'name');
            $this->tag = Tag::all('id', 'name');
            $this->posts = \RainLab\Blog\Models\Post::getListPost();
            return $this->asExtension('FormController')->create();
        } else {
            return redirect(url('/backend/backend/sitebar'));
        }
    }

    public function update($recordId = null)
    {
        $this->category = Category::all('id', 'name');
        $this->tag = Tag::all('id', 'name');
        $this->posts = $this->listPost($recordId);
        $this->post = \Backend\Models\SiteBar::find($recordId);
        $this->listRanking = $this->getListPostRanking($recordId);
        $this->listCurrent = $this->getListPostCurrent($recordId);
        return $this->asExtension('FormController')->update($recordId);
    }

    protected function getListPostRanking($id)
    {
        return \RainLab\Blog\Models\Post::getListPostWithArray($this->listPost($id));
    }

    protected function getListPostCurrent($id)
    {
        return \RainLab\Blog\Models\Post::getListPostCurrent($this->listPost($id));
    }

    protected function listPost($id)
    {
        $post = \Backend\Models\SiteBar::find($id);
        return (array)json_decode($post->content_type);
    }

    public function index_onSave()
    {
        $checkedIds = post('checked');
        $location = post('location');
        $exits = [];
        if (is_array($checkedIds) && count($checkedIds)) {
            foreach ($checkedIds as $id) {
                if ($location[$id] == null) {
                    throw new ValidationException(['error' => e(trans('backend::lang.sitebar.location_required'))]);
                }

                if (!is_numeric($location[$id])) {
                    throw new ValidationException(['error' => e(trans('backend::lang.menu.location_number'))]);
                }
                if (in_array($location[$id], $exits)) {
                    throw new ValidationException(['error' => e(trans('backend::lang.menu.location_exist'))]);
                }
                $exits[] = $location[$id];
            }
            \Backend\Models\SiteBar::saveLocation($checkedIds, $location);
        } else {
            \Backend\Models\SiteBar::removeAllActive();
        }
        Session::flash('success', e(trans('backend::lang.sitebar.update_success')));
        return redirect(url('backend/backend/sitebar'));
    }
}
