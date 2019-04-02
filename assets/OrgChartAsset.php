<?php
namespace devskyfly\yiiModuleIitDocs\assets;

use yii\web\AssetBundle;

class OrgChartAsset extends AssetBundle
{
    public $depends = [
        'yii\web\YiiAsset'
    ];
    
    public $sourcePath = __DIR__.'/orgchart/';

    public function init()
    {
        parent::init();
        //if(YII_ENV_PROD){
            $this->js = [
                'js/jquery.orgchart.js'
            ];
            $this->css = [
                'css/jquery.orgchart.css'
            ];
       /*  }else{
            $this->js = [
                'js/jquery.orgchart.min.js'
            ];
            $this->css = [
                'css/jquery.orgchart.min.css'
            ];
        } */
    }
}