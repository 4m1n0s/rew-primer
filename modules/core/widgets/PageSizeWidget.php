<?php

namespace app\modules\core\widgets;

use yii\base\Widget;
use yii\helpers\Html;

/**
 * Class PageSizeWidget
 *
 * @author Stableflow
 */
class PageSizeWidget extends Widget {

    /**
     * @var string
     */
    public $label = 'records';

    /**
     * @var integer
     */
    public $defaultPageSize = 20;

    /**
     * @var string 
     */
    public $pageSizeParam = 'per-page';

    /**
     * @var array 
     */
    public $sizes = [5 => 5, 10 => 10, 15 => 15, 20 => 20, 25 => 25, 50 => 50, 0 => 'All'];

    /**
     * @var string 
     */
    public $template = '{list} {label}';

    /**
     * @var array
     */
    public $options;

    /**
     * @var array
     */
    public $labelOptions;

    /**
     * @var boolean
     */
    public $encodeLabel = true;

    /**
     * Runs the widget and render the output
     */
    public function run() {
        if (empty($this->options['id'])) {
            $this->options['id'] = $this->id;
        }

        if ($this->encodeLabel) {
            $this->label = Html::encode($this->label);
        }

        $perPage = !empty($_GET[$this->pageSizeParam]) ? $_GET[$this->pageSizeParam] : $this->defaultPageSize;

        $listHtml = Html::dropDownList('per-page', $perPage, $this->sizes, $this->options);
        $labelHtml = Html::label($this->label, $this->options['id'], $this->labelOptions);

        $output = strtr($this->template, [
            '{label}'   => $labelHtml,
            '{list}'    => $listHtml,
        ]);

        return $output;
    }

}
