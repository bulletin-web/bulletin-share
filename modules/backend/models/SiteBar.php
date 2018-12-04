<?php
/**
 * Created by PhpStorm.
 * User: canhph
 * Date: 7/19/18
 * Time: 1:10 PM
 */

namespace Backend\Models;

use Illuminate\Support\Facades\DB;
use October\Rain\Exception\ValidationException as ValidationException;
use Model;

class SiteBar extends Model
{
    use \October\Rain\Database\Traits\Validation;

    protected $table = 'backend_sitebar';

    public $rules = [
        'name' => 'required'
    ];

    public $attributeNames = [
        'name' => 'タイトル',
        'location' => '順番',
        'banner_image' => 'バナー'
    ];

    public $attachOne = [
        'banner_image' => ['System\Models\File']
    ];

    /**
     * Before Save
     *
     * @throws ValidationException
     */
    public function beforeSave()
    {
        if (post('SiteBar')['type'] == 1) {
            if (!isset(post('SiteBar')['post'])) {
                throw new ValidationException(['error' => e(trans('backend::lang.sitebar.list_post_required'))]);
            }
        }

        if (post('SiteBar')['type'] == 2) {
            if (!isset(post('SiteBar')['limit'])) {
                throw new ValidationException(['error' => e(trans('backend::lang.sitebar.limit_regex'))]);
            }
        }

        $post = [];

        if (isset(post('SiteBar')['post'])) {
            $posts = post('SiteBar')['post'];
            foreach ($posts as $key => $value) {
                if (isset($post[$value])) {
                    throw new ValidationException(['error' => e(trans('backend::lang.workflow.location_exist'))]);
                }
                $post[$value] = $key;
            }
        }

        if (isset(post('SiteBar')['limit'])) {
            $limit = post('SiteBar')['limit'];
            if (!is_numeric($limit) || $limit > 5 || $limit < 1) {
                throw new ValidationException(['error' => e(trans('backend::lang.sitebar.limit_regex'))]);
            }
            $post = [
                'limit' => post('SiteBar')['limit'],
                'view' => post('SiteBar')['view']
            ];
        }

        if (post('SiteBar')['type'] == 3) {
            $post['category'] = post('SiteBar')['category'];
            $post['tag'] = post('SiteBar')['tag'];
            $post['link'] = post('SiteBar')['link'];
            $post['post_newest'] = post('SiteBar')['post_newest'];
        }

        if (post('SiteBar')['type'] == 4) {
            $post['css_list_tag'] = post('SiteBar')['css_list_tag'];
            $post['min_post_list_tag'] = post('SiteBar')['min_post_list_tag'];
            $post['sort_by_list_tag'] = post('SiteBar')['sort_by_list_tag'];
            $post['display_count_list_tag'] = post('SiteBar')['display_count_list_tag'];
        }

        ksort($post);

        $this->content_type = json_encode($post);

        $this->type = (int)post('SiteBar')['type'];
    }

    /**
     * Before validate
     *
     * @throws ValidationException
     */
    public function beforeValidate()
    {
        if (isset(post('SiteBar')['post'])) {
            $posts = post('SiteBar')['post'];
            foreach ($posts as $location) {
                if (!$location) {
                    $this->rules['location'] = 'required';
                } elseif (!is_numeric($location)) {
                    throw new ValidationException(['error' => e(trans('backend::lang.workflow.location_number'))]);
                }
            }
        }

        if (post('SiteBar')['type'] == 3) {
            $this->rules['banner_image'] = 'required';
        }

        if (post('SiteBar')['type'] == 4) {
            if (empty(post('SiteBar')['name'])) {
                throw new ValidationException(['error' => 'タイトルは、必ず指定してください。']);
            }
            if (empty(post('SiteBar')['css_list_tag'])) {
                throw new ValidationException(['error' => 'CSSクラスを入力してくささい。']);
            }
            if (empty(post('SiteBar')['min_post_list_tag'])) {
                throw new ValidationException(['error' => '最小記事件数設定を入力してください。']);
            }
        }

        if (!empty(post('SiteBar')['link'])) {
            if (strpos(post('SiteBar')['link'], 'http') === false && strpos(post('SiteBar')['link'], 'https') === false ) {
                throw new ValidationException(['error' => 'リンクには、有効な正規表現を指定してください。']);
            }
        }
    }

    public static function saveLocation($ids, $location)
    {
        DB::beginTransaction();
        try {
            foreach ($ids as $id) {
                DB::table('backend_sitebar')
                    ->where('id', $id)
                    ->update(['location' => $location[$id], 'active' => true]);
            }
            foreach ($ids as $id) {
                DB::table('backend_sitebar')
                    ->where('id', '!=', $id)
                    ->whereNotIn('id', $ids)
                    ->update(['location' => null, 'active' => false]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
    }

    public static function removeAllActive()
    {
        DB::table('backend_sitebar')
            ->update(['location' => null, 'active' => false]);
    }

    public static function getListSiteBar()
    {
        return SiteBar::where('active', true)
            ->orderBy('location')
            ->get();
    }
}
