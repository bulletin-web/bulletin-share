<?php
/**
 * Created by PhpStorm.
 * User: ken
 * Date: 30/01/2018
 * Time: 11:08
 */

namespace Backend\Models;

use Model;
use October\Rain\Exception\ValidationException as ValidationException;

class Menu extends Model
{
    use \October\Rain\Database\Traits\Validation;

    protected $table = 'backend_menu';

    public $rules = [
        'name' => 'required',
        'type' => 'required'
    ];

    public $attributeNames = [
        'name' => 'メニュー名',
        'type' => 'メニュータイプ',
        'location' => '順番'
    ];

    public function beforeSave()
    {
        if (!isset(post('Menu')['category']) && !isset(post('Menu')['tag']) && !isset(post('Menu')['page'])) {
            throw new ValidationException(['error' => e(trans('backend::lang.menu.menu_list_required'))]);
        }
        $this->name = strip_tags($this->name);
        $menu = [];
        if (isset(post('Menu')['category'])) {
            $categories = post('Menu')['category'];
            foreach ($categories as $key => $value) {
                if (isset($menu[$value])) {
                    throw new ValidationException(['error' => e(trans('backend::lang.menu.location_exist'))]);
                }
                $menu[$value] = [
                    'type' => 'category',
                    'id' => $key
                ];
            }
        }
        if (isset(post('Menu')['tag'])) {
            $tags = post('Menu')['tag'];
            foreach ($tags as $key => $value) {
                if (isset($menu[$value])) {
                    throw new ValidationException(['error' => e(trans('backend::lang.menu.location_exist'))]);
                }
                $menu[$value] = [
                    'type' => 'tag',
                    'id' => $key
                ];
            }
        }
        if (isset(post('Menu')['page'])) {
            $pages = post('Menu')['page'];
            foreach ($pages as $key => $value) {
                if (isset($menu[$value])) {
                    throw new ValidationException(['error' => e(trans('backend::lang.menu.location_exist'))]);
                }
                $menu[$value] = [
                    'type' => 'page',
                    'id' => $key
                ];
            }
        }
        ksort($menu);
        $this->menu_list = json_encode($menu);

        if (post('Menu')['is_active']) {
            $this->where([
                'type' => post('Menu')['type'],
                'is_active' => 1
            ])->update(['is_active' => false]);
            $this->is_active = true;
        }
    }

    /**
     * Check Before Validate
     *
     * @throws ValidationException
     */
    public function beforeValidate()
    {
        if (isset(post('Menu')['category'])) {
            $categories = post('Menu')['category'];
            foreach ($categories as $location) {
                if (!$location) {
                    $this->rules['location'] = 'required';
                } elseif (!is_numeric($location)) {
                    throw new ValidationException(['error' => e(trans('backend::lang.menu.location_number'))]);
                }
            }
        }
        if (isset(post('Menu')['tag'])) {
            $tags = post('Menu')['tag'];
            foreach ($tags as $location) {
                if (!$location) {
                    $this->rules['location'] = 'required';
                } elseif (!is_numeric($location)) {
                    throw new ValidationException(['error' => e(trans('backend::lang.menu.location_number'))]);
                }
            }
        }
        if (isset(post('Menu')['page'])) {
            $pages = post('Menu')['page'];
            foreach ($pages as $location) {
                if (!$location) {
                    $this->rules['location'] = 'required';
                } elseif (!is_numeric($location)) {
                    throw new ValidationException(['error' => e(trans('backend::lang.menu.location_number'))]);
                }
            }
        }
    }
}