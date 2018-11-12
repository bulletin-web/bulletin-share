<?php 
class Cms5b87a12c942d7024220234_0d35c1ff1dae18ae7c23497786607eaaClass extends \Cms\Classes\PartialCode
{
public function onStart() {
if ($this->tag) {
$this['active'] = '/blog/tags/'.$this->tag->slug;
}
if ($this->category) {
$this['active'] = '/blog/category/'.$this->category->slug;
}
}
}
