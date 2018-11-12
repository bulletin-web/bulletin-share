<?php
/**
 * Created by PhpStorm.
 * User: ken
 * Date: 02/02/2018
 * Time: 13:57
 */

namespace Backend\Models;

use October\Rain\Exception\ValidationException as ValidationException;
use Model;
use RainLab\Blog\Models\Post;

class WorkFlow extends Model
{
    use \October\Rain\Database\Traits\Validation;

    protected $table = 'backend_workflow';

    public $rules = [
        'name' => 'required'
    ];

    public $attributeNames = [
        'name' => 'ルート名',
        'location' => '順番'
    ];

    public function beforeSave()
    {
        if (!isset(post('WorkFlow')['user'])) {
            throw new ValidationException(['error' => e(trans('backend::lang.workflow.approve_list_required'))]);
        }
        $this->name = strip_tags($this->name);
        $user = [];
        if (isset(post('WorkFlow')['user'])) {
            $users = post('WorkFlow')['user'];
            foreach ($users as $key => $value) {
                if (isset($user[$value])) {
                    throw new ValidationException(['error' => e(trans('backend::lang.workflow.location_exist'))]);
                }
                $user[$value] = [
                    'type' => 'user',
                    'id' => $key
                ];
            }
        }

        ksort($user);
        $this->approve_list = json_encode($user);

        if ($this->id) {
            Post::where('workflow_id', $this->id)
                ->where('published', false)
                ->update([
                    'status' => 2,
                    'count_approve' => false,
                    'reviewer_read' => false,
                    'reviewer_comment' => null,
                    'post_reject' => false,
                    'owner_read_notify' => false,
                    'is_update' => false,
                    'reviewer_id' => $this->getReviewerId($user)
                ]);
        }
    }

    public function getReviewerId($user) {
        foreach ($user as $value) {
            return $value['id'];
        }
    }

    public function beforeValidate()
    {
        if (isset(post('WorkFlow')['user'])) {
            $users = post('WorkFlow')['user'];
            foreach ($users as $location) {
                if (!$location) {
                    $this->rules['location'] = 'required';
                } elseif (!is_numeric($location)) {
                    throw new ValidationException(['error' => e(trans('backend::lang.workflow.location_number'))]);
                }
            }
        }
    }

    public function beforeDelete()
    {
        Post::where('workflow_id', $this->id)
            ->update([
                'workflow_id' => null,
                'reviewer_id' => null,
                'count_approve' => false
            ]);
    }
}