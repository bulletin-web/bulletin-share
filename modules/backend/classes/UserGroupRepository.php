<?php namespace Backend\Classes;

use Backend\Models\UserGroup;
/**
 * Class UserGroupRepository
 * @package Backend\Classes
 */
class UserGroupRepository
{
    public function getAllSortByDisplayOrder()
    {
        return UserGroup::orderBy('display_order')->get()->pluck('name', 'id');
    }

    public function saveDisplayOrder($data)
    {
        $counter=1;
        foreach($data as $key=>$val)
        {
            $this->saveRecord($val,$counter);
            $counter++;
        }
    }

    private function saveRecord($id,$order)
    {
        $group = UserGroup::find($id);

        if ($group) {
            $group->display_order = $order;

            if ($group->save()) {
                return true;
            }
        }

        return false;

    }
}
