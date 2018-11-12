<?php namespace October\Demo\Components;

use Backend\Models\Info as Info;
use Cms\Classes\ComponentBase;
use ApplicationException;
use Backend\Models\DisplaySetting as DisplaySetting;
use Illuminate\Http\Request;

class Settings extends ComponentBase {

	public $displaySetting;
	public $infoSetting;

	public function componentDetails() {
		return [
			'name'        => 'Setting List',
			'description' => 'Implements setting list'
		];
	}

	public function onRun() {
		$this->displaySetting = $this->page['displaySetting'] = $this->getDisplaySetting();
		$this->infoSetting = $this->page['infoSetting'] = $this->getInfoSetting();
		$this->page['infoSetting'] = Info::first();
	}

	public function getDisplaySetting() {
		$setting = new DisplaySetting();
		$dataSetting = $setting->first();
		if (empty($dataSetting->logo)) {
			$dataSetting['logo'] = url('/themes/demo/assets/images/common/logo.png');
		}

		if (empty($dataSetting->display_special_page)) {
			$dataSetting['display_special_page'] = 0;
		}

		if (empty($dataSetting->menu_color)) {
			$dataSetting['menu_color'] = "#F2F2F2";
		}

		if (!isset($dataSetting->slide_enable)) {
			$dataSetting['slide_enable'] = 1;
		}
		return $dataSetting;
	}

	public function getInfoSetting() {
		$info = new Info();
		$infoSetting = $info->first();

		if (empty($infoSetting->site_name)) {
			$infoSetting['site_name'] = "BLOG";
		}

		if (!isset($infoSetting->searchable)) {
			$infoSetting['searchable'] = 1;
		}

		if (!isset($infoSetting->accept_facebook)) {
			$infoSetting['accept_facebook'] = 0;
		}

		if (!isset($infoSetting->accept_twitter)) {
			$infoSetting['accept_twitter'] = 0;
		}

		return $infoSetting;
	}
}