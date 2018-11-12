<?php 
class Cms5b87a15525b82788233180_c83b4ddea672bccc9bab4343cbef887dClass extends \Cms\Classes\PageCode
{
public function onEnd() {
    $this['hasPreview'] = true;
    if ($this->preview) {
        $this->page->title = $this->preview->title;
        $this['hasPreview'] = true;
} else {
    return Redirect::to('404');
}
}
}
