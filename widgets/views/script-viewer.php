<?php
/* $this yii\web\view */
/* $scriptsTree [] */
/* $mode string */
use devskyfly\yiiModuleIitDocs\assets\OrgChartAsset;
use yii\helpers\Json;
use devskyfly\yiiModuleIitDocs\Module;
?>

<?

$widgetCls=Module::CSS_NAMESPACE.'__scripts_view_'.$mode;
OrgChartAsset::register($this);

$orgChartData = [
    "name" => $mode,
    "children"=>$scriptsTree
];

$options = [
    "data" => $orgChartData,
    'direction' => 'l2r'
];
$json=Json::encode($options);
?>

<div class="<?=$widgetCls?>" style="height: 800px;"></div>

<?
$js_code=<<<JS_CODE
var oc = $('.$widgetCls').orgchart($json);
JS_CODE;

$js_code=str_replace(['','',''], ["\n","\r","\t"], $js_code);
$this->registerJs($js_code,$this::POS_LOAD);
?>