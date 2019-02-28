<?php
namespace devskyfly\yiiModuleIitDocs;

use devskyfly\php56\types\Lgc;
use devskyfly\php56\types\Str;
use devskyfly\php56\types\Vrbl;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class Module extends \yii\base\Module
{
     
     public function init()
     {
         parent::init();
         $this->checkProperties();
         if(Yii::$app instanceof \yii\console\Application){
             $this->controllerNamespace='devskyfly\yiiModuleIitPartners\console';
         }
     }
     
     public function behaviors()
     {
         if(!(Yii::$app instanceof \yii\console\Application)){
             return [
                 'access' => [
                     'class' => AccessControl::className(),
                     'except'=>[
                         'rest/*/*',
                     ],
                     'rules' => [
                          [
                             'allow' => true,
                             'roles' => ['@'],
                         ], 
                     ],
                 ]
             ];
         }else{
             return [];
         }
     }
}