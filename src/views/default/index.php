<?php
/* $this yii/web/view */
/* $list []*/
/* $title string */
use devskyfly\yiiModuleAdminPanel\widgets\common\NavigationMenu;
use devskyfly\yiiModuleIitUc\widgets\RatesTree;
use devskyfly\yiiModuleIitDocs\widgets\ScriptsViewer;
use yii\base\Widget;
use yii\bootstrap\Tabs;
use devskyfly\yiiModuleIitDocs\models\ucScript\Section;
use devskyfly\yiiModuleIitDocs\widgets\DocumentsPackagesViewer;
?>
<?
$this->title=$title;
?>
<div class="row">
    <div class="col-xs-3">
    	<?=NavigationMenu::widget(['list'=>$list])?>
    </div>
    
    <div class="col-xs-9" style="overflow:auto">
    	<?=DocumentsPackagesViewer::widget()?>
    	<div class="col-lg-12">
    		<h1>Сценарии</h1>
    	</div>
    	<?=Tabs::widget(['items'=>[
    	    ['label'=>'Uc','content'=>ScriptsViewer::widget(['mode'=>ScriptsViewer::MODE_UC])],
    	    ['label'=>'Report','content'=>ScriptsViewer::widget(['mode'=>ScriptsViewer::MODE_REPORT])]
    	]]);?>
    </div>
</div>