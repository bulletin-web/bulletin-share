<?php namespace Backend\FormWidgets;

use Backend\Classes\FormWidgetBase;

/**
 * Color picker
 * Renders a color picker field.
 *
 * @package october\backend
 * @author Alexey Bobkov, Samuel Georges
 */
class ColorPicker extends FormWidgetBase
{
    //
    // Configurable properties
    //

    /**
     * @var array Default available colors
     */
    public $availableColors = [
        '#fefefe', '#000000', '#e6e5e5', '#425469', '#529ad2', '#f17c37', '#a4a4a4', '#febe26', '#3a73c1', '#6dac4d',
        '#f1f1f1', '#808080', '#cecccc', '#d3dbe3', '#dce9f5', '#fce3d5', '#ececec', '#fef1cd', '#d7e1f1', '#e1eed9',
        '#d8d8d8', '#595959', '#aeaaaa', '#aab8c8', '#bbd6ed', '#f9c9ac', '#dadada', '#fee49b', '#b1c5e5', '#c3df34',
        '#bebebe', '#404040', '#747070', '#8195ae', '#97c1e3', '#f7ae84', '#c8c8c8', '#fed76d', '#89a9d9', '#a5cf8f',
        '#a5a5a5', '#262626', '#3b3838', '#313e4e', '#1d74b2', '#c85819', '#7b7b7b', '#c18da1', '#275493', '#51803a',
        '#7e7e7e', '#0d0d0d', '#161616', '#202934', '#144d77', '#843a0f', '#525252', '#805e0e', '#1a3762', '#365626',
    ];

    /**
     * @var bool Allow empty value
     */
    public $allowEmpty = false;

    /**
     * @var bool Show opacity slider
     */
    public $showAlpha = false;

    //
    // Object properties
    //

    /**
     * @inheritDoc
     */
    protected $defaultAlias = 'colorpicker';

    /**
     * @inheritDoc
     */
    public function init()
    {
        $this->fillFromConfig([
            'availableColors',
            'allowEmpty',
            'showAlpha',
        ]);
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        $this->prepareVars();
        return $this->makePartial('colorpicker');
    }

    /**
     * Prepares the list data
     */
    public function prepareVars()
    {
        $this->vars['name'] = $this->getFieldName();
        $this->vars['value'] = $value = $this->getLoadValue();
        $this->vars['availableColors'] = $this->availableColors;
        $this->vars['allowEmpty'] = $this->allowEmpty;
        $this->vars['showAlpha'] = $this->showAlpha;
        $this->vars['isCustomColor'] = !in_array($value, $this->availableColors);
    }

    /**
     * @inheritDoc
     */
    protected function loadAssets()
    {
        $this->addCss('vendor/spectrum/spectrum.css', 'core');
        $this->addJs('vendor/spectrum/spectrum.js', 'core');
        $this->addCss('css/colorpicker.css', 'core');
        $this->addJs('js/colorpicker.js', 'core');
    }

    /**
     * @inheritDoc
     */
    public function getSaveValue($value)
    {
        return strlen($value) ? $value : null;
    }
}
