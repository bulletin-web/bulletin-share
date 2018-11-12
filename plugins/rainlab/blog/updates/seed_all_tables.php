<?php namespace RainLab\Blog\Updates;

use Carbon\Carbon;
use RainLab\Blog\Models\Post;
use RainLab\Blog\Models\Category;
use RainLab\Blog\Models\Tag;
use October\Rain\Database\Updates\Seeder;
use File;

class SeedAllTables extends Seeder
{

    public function run()
    {
        $category = Category::create([
            'name' => trans('rainlab.blog::lang.categories.uncategorized'),
            'color' => '#9fc78d',
            'slug' => 'uncategorized',
        ]);

        $tag = Tag::create([
            'name' =>  trans('rainlab.blog::lang.categories.uncategorized'),
            'slug' => 'uncategorized',
            'category_id' => $category->id,
            'tag_color' => '#9fc78d',
            'parent_tag_id' => 0,
        ]);



        $file = new File;
        $file->data = 'test.jpg';

        $post = Post::create([
            'title' => 'First blog post',
            'slug' => 'first-blog-post',
            'content' => '
This is your first ever **blog post**! It might be a good idea to update this post with some more relevant content.

You can edit this content by selecting **Blog** from the administration back-end menu.

*Enjoy the good times!*
            ',
            'excerpt' => 'The first ever blog post is here. It might be a good idea to update this post with some more relevant content.',
            'published_at' => Carbon::now(),
            'published' => true,
            'category_id' => $category->id,
            'reviewer_id' => 1,
            'featured_image' => $file,
            'has_comment' => 0,
            'tags' => $tag->id,
        ]);

        $post->addTag($tag);
    }

}
