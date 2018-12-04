<?php namespace Backend\Models;

use Model;

/**
 * Administrator group
 *
 * @package october\backend
 * @author Alexey Bobkov, Samuel Georges
 */
class Info extends Model
{
    protected $table = 'site_info_setting';

    protected $fillable = ['id', 'status', 'site_name', 'site_url', 'copyright', 'is_limit_ip', 'ip_address', 'is_certificate', 'is_basicauth', 'username_certificate', 'password_certificate', 'admin_email', 'searchable', 'accept_facebook', 'accept_twitter', 'access_analysis_tag', 'license', 'user_create_id', 'user_update_id', 'like_status', 'icon_new_display_page', 'icon_new_count_day_view', 'icon_new_text_view', 'icon_new_title_view'];
}
