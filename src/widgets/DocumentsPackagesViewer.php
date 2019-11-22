<?php
namespace devskyfly\yiiModuleIitDocs\widgets;

use yii\base\Widget;
use devskyfly\yiiModuleIitDocs\models\document\Document;
use devskyfly\yiiModuleIitDocs\models\documentPackage\DocumentPackage;
use devskyfly\yiiModuleIitDocs\models\documentPackage\DocumentPackageToDocumentBinder;

class DocumentsPackagesViewer extends Widget
{
    public function init()
    {
        
    }
    
    public function run()
    {
        $data=[];
        
        $packages=DocumentPackage::find()->orderBy(['name'=>SORT_ASC])->all();
        
        foreach ($packages as $package){
            
            $ids=DocumentPackageToDocumentBinder::getSlaveIdsByItem($package);
            $docs=Document::find()->where(['id'=>$ids])->all();
            
            $data[]=['package'=>$package,'documents'=>$docs];
        }
        
        return $this->render('documentsPackagesViewer/template',compact("data"));
    }
}