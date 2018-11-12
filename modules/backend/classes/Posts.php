<?php
/**
 * Created by PhpStorm.
 * User: ken
 * Date: 5/8/18
 * Time: 4:37 PM
 */

namespace Backend\Classes;

use RainLab\Blog\Models\Post;


class Posts extends Controller
{

    /**
     * @return string
     */
    public function getSlug()
    {
        $current = date('Ymd');
        $posts = Post::where('created_at', 'LIKE', '%'.date('Y-m-d').'%')
            ->where('slug', 'LIKE', '%'.$current.'%')
            ->get();
        $listRand = [];
        foreach ($posts as $post) {
            array_push($listRand, (int)str_replace($current.'-', '', $post->slug));
        }
        ksort($listRand);
        if ($listRand) {
            foreach ($listRand as $key => $num) {
                if ($key + 1 != $num) {
                    if (in_array($key + 1, $listRand)) {
                        continue;
                    } else {
                        return $current.'-'.$this->parseNumber($key + 1);
                    }
                }
            }
            return $current.'-'.$this->parseNumber(count($listRand) + 1);
        }
        return $current.'-001';
    }

    /**
     * @param $num
     * @return string
     */
    public function parseNumber($num)
    {
        switch (strlen($num)) {
            case 1:
                return '00'.$num;
            case 2:
                return '0'.$num;
            default:
                return $num;
        }
    }
}