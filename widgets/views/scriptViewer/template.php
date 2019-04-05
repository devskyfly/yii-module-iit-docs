<?php
/* $this yii\web\view */
/* $scriptsTree [] */
/* $mode string */
use devskyfly\yiiModuleIitDocs\assets\OrgChartAsset;
use devskyfly\yiiModuleIitDocs\widgets\views\scriptViewer\ScriptViewerAsset;
use yii\helpers\Json;
use yii\helpers\Url;
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
$modal_id="{$widgetCls}__docs-viewer_{$mode}";
?>

<!-- Modal -->
<div class="modal fade" id="<?=$modal_id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Документы</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<div class="<?=$widgetCls?>" style="height: 800px;"></div>
<?

$docs_chain_route=Url::toRoute(['/iit-docs/rest/documents-chain/index']);
$js_code=<<<JS_CODE

var json=$json;

json.createNode= function(node, data) {
    var secondMenuIcon = $('<div>', {
        'class': 'second-menu-icon',
    });

    var icon = $('<div>', {
        class: 'glyphicon glyphicon-log-out',
        style:'padding-left:10px;',
        click: function() {
            $(node).find('.content').toggle();
        }
    });

    var docsIcon = $('<div>', {
       class: 'glyphicon glyphicon-list-alt',
       click: function() {
            var section_id = $(this).parents('.node').prop('id');
            $.get('$docs_chain_route',{"section_id":section_id,"mode":'$mode'},function(data){
                $('#{$modal_id} .modal-body').html(data);
                $('#{$modal_id}').modal('show');
            });
            
        }
    });

    

    secondMenuIcon.append(docsIcon);
    secondMenuIcon.append(icon);
    
    node.append(secondMenuIcon);
};
var oc = $('.$widgetCls').orgchart(json);
JS_CODE;

$js_code=str_replace(['','',''], ["\n","\r","\t"], $js_code);
$this->registerJs($js_code,$this::POS_LOAD);
?>