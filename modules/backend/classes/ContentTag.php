<?php
/**
 * Created by PhpStorm.
 * User: ken
 * Date: 22/01/2018
 * Time: 10:33
 */

namespace Backend\Classes;


use Illuminate\Support\Facades\DB;
use League\Flysystem\Exception;
use RainLab\Blog\Models\Post;
use RainLab\Blog\Models\Tag;
use Validator;

class ContentTag extends Controller
{

    public $rules = [
        'name' => 'required|unique:content_tag|between:1,64',
        'slug' => 'required|unique:content_tag|between:1,64|regex:/^[a-z0-9][-a-z0-9]*$/',
        'tag_color' => 'required'
        ];

    public $message = [
        'name.required' => 'タグ名は、必ず指定してください。',
        'name.between' => 'タグ名は、1文字から64文字にしてください。',
        'slug.required' => 'URLは、必ず指定してください。',
        'slug.between' => 'URLは、1文字から64文字にしてください。',
        'slug.regex' => 'URLには、有効な正規表現を指定してください。',
        'tag_prioritize.required_if' => '優先タグを選択してください。',
        'parent_tag_list.required_if' => '親タグを選択してください。',
    ];

    public function rulesUpdate($tag_id)
    {
        return [
            'name' => 'required|between:1,64|unique:content_tag,name,'.$tag_id,
            'slug' => 'required|between:1,64|regex:/^[a-z0-9][-a-z0-9]*$/|unique:content_tag,slug,'.$tag_id,
            'tag_color' => 'required'
        ];
    }

    /**
     * @return mixed
     */
    public function getParentTag()
    {
        return DB::table('content_tag')
            ->select('id', 'name')
            ->where('is_parent', true)
            ->get();
    }

    public function insert($post)
    {
        $context = [
            'name' => strip_tags($post['name']),
            'slug' => $post['slug'],
            'description' => $post['description'],
            'tag_color' => $post['tag_color'],
        ];

        return DB::table('content_tag')->insert($context);
    }

    public function insertTagRelationTable($post, $tag_id)
    {
        try {
            DB::beginTransaction();
            foreach ($post['parent_tag_list'] as $parent_id) {
                DB::table('content_tag_parent_children')
                    ->insert(
                        [
                            'parent_tag_id' => $parent_id,
                            'children_tag_id' => $tag_id
                        ]
                    );
            }
            DB::commit();
            return true;
        } catch (Exception $exception) {
            DB::rollBack();
            return false;
        }
    }

    public function update($post, $tag_id)
    {
        if($this->isCheckTag($tag_id)){
            try {
                DB::beginTransaction();
                $this->updateTagTable($post, $tag_id);
                DB::commit();
                return true;
            } catch (Exception $exception) {
                DB::rollBack();
                return false;
            }
        }
    }
    public function isCheckTag($tag_id){
        $data =  Tag::find($tag_id);
        if($data == null){
            return false;
        }
        return true;
    }

    public function deleteRelationTag($tag_id)
    {
        return DB::table('content_tag_parent_children')
            ->where('children_tag_id', $tag_id)
            ->orWhere('parent_tag_id', $tag_id)
            ->delete();
    }

    public function updateTagTable($post, $tag_id)
    {
        $context = [
            'name' => strip_tags($post['name']),
            'slug' => $post['slug'],
            'description' => $post['description'],
            'tag_color' => $post['tag_color'],
        ];
        DB::table('content_tag')
            ->where('id', $tag_id)
            ->update($context);
        return true;
    }

    public function deleteTag($tag_id)
    {
        try {
            DB::beginTransaction();
            if ($this->detailTag($tag_id)){
                $this->deleteContentTag($tag_id);
                $this->deleteRelationTag($tag_id);
                $this->deletePostTag($tag_id);
            }
            DB::commit();
            return true;
        } catch (Exception $exception) {
            DB::rollBack();
            return false;
        }
    }

    public function deletePostTag($tag_id)
    {
        return DB::table('rainlab_blog_posts_tags')
            ->where('tag_id', $tag_id)
            ->delete();
    }

    public function deleteContentTag($tag_id)
    {
        return DB::table('content_tag')
            ->where('id', $tag_id)
            ->delete();
    }

    public function deleteRelationTagById($tag_id)
    {
        return DB::table('content_tag_parent_children')
            ->where('id', $tag_id)
            ->delete();
    }

    /**
     * @param $post
     * @return mixed
     */
    public function validator($post)
    {
        return Validator::make($post, $this->rules, $this->message);
    }

    public function validatorUpdate($post, $tag_id)
    {
        return Validator::make($post, $this->rulesUpdate($tag_id), $this->message);
    }

    public function getCurrentListParentTag($tag_id, $detailTag)
    {
        $listCurent = [];
        foreach ($this->getParentTag() as $tag) {
            $listCurent[$tag->id] = [
                'id' => $tag->id,
                'name' => $tag->name
            ];
        }
        $listOfTag = Tag::find($tag_id)->relation_tag;
        foreach($listOfTag as $tag) {
            unset($listCurent[$tag->parent_tag->id]);
        }
        unset($listCurent[$detailTag->id]);
        return $listCurent;
    }

    public function getRelationTag($tag_id)
    {
        return Tag::find($tag_id)->relation_tag;
    }

    public function detailTag($tag_id)
    {
        return Tag::find($tag_id);
    }

    public function getParentTagList()
    {
        $parentTagList = [];
        if ($tags = Tag::where('is_parent', true)->get()) {
            foreach ($tags as $tag) {
                $parentTagList[$tag->id] = $tag;
            }
        }
        return $parentTagList;
    }

    public function getChildrenTagList()
    {
        $childrenTagList = [];
        if ($tags = Tag::where('is_parent', false)->get()) {
            foreach ($tags as $tag) {
                $childrenTagList[$tag->id] = $tag;
            }
        }
        return $childrenTagList;
    }
    public function getTagList(){
        $tagList = [];
        $tags = Tag::all();
        if ($tags) {
            foreach ($tags as $tag) {
                $tagList[$tag->id] = $tag;
            }
        }
        return $tagList;
    }

    public function getParentTagOfPost($post_id)
    {
        $post = Post::find($post_id);
        $parentTagOfPost = [];
        if ($post->parent_tag_list) {
            foreach (json_decode($post->parent_tag_list) as $tag_id) {
                if (isset($this->getAllTagOfPost($post_id)[$tag_id])) {
                    $parentTagOfPost[$tag_id] = $this->getAllTagOfPost($post_id)[$tag_id];
                }
            }
        }
        return $parentTagOfPost;
    }

    public function getChildrenTagOfPost($post_id)
    {
        $post = Post::find($post_id);
        $childrenTagOfPost = [];
        if ($post->children_tag_list) {
            foreach (json_decode($post->children_tag_list) as $tag_id) {
                if (isset($this->getAllTagOfPost($post_id)[$tag_id])) {
                    $childrenTagOfPost[$tag_id] = $this->getAllTagOfPost($post_id)[$tag_id];
                }
            }
        }
        return $childrenTagOfPost;
    }

    public function getParentTaglistCurrent($post_id)
    {
        $post = Post::find($post_id);
        $parentTagListCurrent = $this->getTagList();
        if ($post->parent_tag_list) {
            foreach (json_decode($post->parent_tag_list) as $tag_id) {
                unset($parentTagListCurrent[$tag_id]);
            }
        }
        return $parentTagListCurrent;
    }

    public function getChildrenTagListCurrent($post_id)
    {
        $post = Post::find($post_id);
        $parentTagListCurrent = $this->getChildrenTagList();
        if ($post->children_tag_list) {
            foreach (json_decode($post->children_tag_list) as $tag_id) {
                unset($parentTagListCurrent[$tag_id]);
            }
        }
        return $parentTagListCurrent;
    }

    public function getAllTagOfPost($post_id)
    {
        $listAllTag = [];
        foreach (Post::find($post_id)->tags as $tag) {
            $listAllTag[$tag->id] = $tag;
        }
        return $listAllTag;
    }
}