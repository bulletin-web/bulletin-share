<?php 
class Cms5b87a12ecaf45731784792_e21da6a1c80caf5c5a23a9793b5988a1Class extends \Cms\Classes\PageCode
{
public function onEnd() {
    if ($this->displaySetting['display_special_page']) {
        return Redirect::to($this->displaySetting['url_special_page']);
    }
}
}
