<?php
namespace devskyfly\yiiModuleIitDocs\controllers;

use devskyfly\yiiModuleIitDocs\Module;
use devskyfly\yiiModuleIitDocs\models\common\ModuleNavigation;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $title=Module::TITLE;
        $module_navigation=new ModuleNavigation();
        $list=[$module_navigation->getData()];
        return $this->render('index',compact("list","title"));
    }
}