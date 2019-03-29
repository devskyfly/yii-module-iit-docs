<?php
/* $this yii\web\view */
use devskyfly\yiiModuleIitDocs\assets\OrgChartAsset;
use yii\helpers\Json;
?>

<?
OrgChartAsset::register($this);
?>

<div id="tree" class="" style="height: 800px">

</div>

<?
$orgChartData = [
        "name" => "Uc",
        "children"=>$data
];

$options = [
    "data" => $orgChartData,
    'direction' => 'l2r'
];
$json=Json::encode($options);

$js_code=<<<JS_CODE
var oc = $('#tree').orgchart($json);
JS_CODE;

$js_code=str_replace(['','',''], ["\n","\r","\t"], $js_code);
$this->registerJs($js_code,$this::POS_LOAD);
?>