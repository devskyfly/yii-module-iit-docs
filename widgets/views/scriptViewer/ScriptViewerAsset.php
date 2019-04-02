<?php
namespace devskyfly\yiiModuleIitDocs\widgets\views\scriptViewer;

use yii\web\AssetBundle;

class ScriptViewerAsset extends AssetBundle
{
    public $depends = [
        'yii\web\YiiAsset',
        'devskyfly\yiiModuleIitDocs\assets\OrgChartAsset'
    ];
    
    public $sourcePath = __DIR__.'/';
    
    public function init()
    {
        parent::init();
            $this->css = [
                'style.css'
            ];
    }
}