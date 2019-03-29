<?php
/* $this yii/web/view */
/* $list []*/
/* $title string */
use devskyfly\yiiModuleAdminPanel\widgets\common\NavigationMenu;
use devskyfly\yiiModuleIitUc\widgets\RatesTree;
use devskyfly\yiiModuleIitDocs\widgets\ScriptsViewer;
use yii\base\Widget;
use devskyfly\yiiModuleIitDocs\models\ucScript\Section;
?>
<?
$this->title=$title;
?>
<div class="row">
    <div class="col-xs-3">
    	<?=NavigationMenu::widget(['list'=>$list])?>
    </div>
    <div class="col-xs-9">
    	<?//ScriptsViewer::widget(["sectionCls"=>Section::class])?>
    	<?=ScriptsViewer::widget()?>
    </div>
</div>