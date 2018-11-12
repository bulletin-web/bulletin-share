<?php namespace Backend\Models;

use Model;

class DisplaySetting extends Model
{
    protected $table = 'site_display_setting';

    protected $fillable = ['id', 'logo', 'menu_color', 'display_special_page', 'url_special_page', 'default_tag', 'slide_enable', 'post_per_page', 'user_created_id', 'user_updated_id'];
}