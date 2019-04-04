<?php
/* $this yii\web\view */
/* $scriptsTree [] */
/* $mode string */
use devskyfly\yiiModuleIitDocs\assets\OrgChartAsset;
use devskyfly\yiiModuleIitDocs\widgets\views\scriptViewer\ScriptViewerAsset;
use yii\helpers\Json;
use devskyfly\yiiModuleIitDocs\Module;
?>

<?
$widgetCls=Module::CSS_NAMESPACE.'__scripts_view_'.$mode;

OrgChartAsset::register($this);
ScriptViewerAsset::register($this);

$orgChartData = $scriptsTree;

$options = [
    "data" => $orgChartData,
    'direction' => 'l2r',
    'nodeContent'=> 'content'
    
];
$json=Json::encode($options);
?>
<div class="">
<div class="<?=$widgetCls?>" style="height: 800px;"></div>
</div>
<?

$js_code=<<<JS_CODE
var json=$json;

json.createNode= function(node, data) {
    var secondMenuIcon = $('<i>', {
        'class': 'second-menu-icon',
         
    });
    var icon = $('<span>', {
        class: 'glyphicon glyphicon-list-alt icon',
        click: function() {
            //$(this).siblings('.second-menu').toggle();
            $(node).find('.content').toggle();
        }
    });


    secondMenuIcon.append(icon);
    node.append(secondMenuIcon);
};
var oc = $('.$widgetCls').orgchart(json);
JS_CODE;

$js_code=str_replace(['','',''], ["\n","\r","\t"], $js_code);
$this->registerJs($js_code,$this::POS_LOAD);
?>