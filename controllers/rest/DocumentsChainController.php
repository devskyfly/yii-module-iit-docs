<?php
namespace devskyfly\yiiModuleIitDocs\controllers\rest;

use devskyfly\php56\types\Nmbr;
use devskyfly\php56\types\Vrbl;
use devskyfly\yiiModuleIitDocs\components\ReportScriptManager;
use devskyfly\yiiModuleIitDocs\components\UcScriptManager;
use devskyfly\yiiModuleIitDocs\models\reportScript\Section as SectionReport;
use devskyfly\yiiModuleIitDocs\models\ucScript\Section as SectionUc;
use yii\rest\Controller;
use yii\web\BadRequestHttpException;
use devskyfly\yiiModuleIitDocs\models\reportScript\ReportScript;
use devskyfly\yiiModuleIitDocs\models\ucScript\UcScript;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use devskyfly\yiiModuleIitDocs\models\ucScript\UcScriptToDocumentPackageBinder;
use devskyfly\yiiModuleIitDocs\models\document\Document;
use devskyfly\yiiModuleIitDocs\models\documentPackage\DocumentPackageToDocumentBinder;

class DocumentsChainController extends Controller
{
    public function actionIndex($section_id=null,$mode=null)
    {
        $modes=['uc','report'];
        
        $entities=[];
        
        if(!in_array($mode, $modes)){
            throw new BadRequestHttpException('Parameter $mode out of range.');
        }
        
        if($mode=='uc'){
            $entities=ArrayHelper::merge($entities, UcScript::find()->andWhere(['_section__id'=>null])->all());
        }elseif ($mode=='report'){
            $entities=ArrayHelper::merge($entities, ReportScript::find()->andWhere(['_section__id'=>null])->all());
        }
        
        if(!Vrbl::isNull($section_id)){
            $section_id=Nmbr::toIntegerStrict($section_id);
            
            if($mode=='uc'){
                $section=SectionUc::getById($section_id);
            }elseif ($mode=='report'){
                $section=SectionReport::getById($section_id);
            }
            
            if($mode=='uc'){
                $chain=UcScriptManager::getChain($section);
            }elseif ($mode=='report'){
                $chain=ReportScriptManager::getChain($section);
            }
            
            foreach ($chain as $chain_item){
                if($chain_item->active!='Y'){
                    continue;
                }
                $chain_entities=$chain_item->getEntities();
                $entities=ArrayHelper::merge($entities,$chain_entities);
            }
        }
        
        $packages=[];
        
        foreach ($entities as $entity){
            if($entity->active!='Y'){
                continue;
            }
            if($mode=='uc'){
                $packages=ArrayHelper::merge($packages,UcScriptToDocumentPackageBinder::getSlaveItems($entity->id));
            }elseif ($mode=='report'){
                $packages=ArrayHelper::merge($packages,UcScriptToDocumentPackageBinder::getSlaveItems($entity->id));
            }
        }
        
        $docs=[];
        $docs_ids=[];
        
        foreach($packages as $package){
            if($package->active!='Y'){
                continue;
            }
            $docs_ids=ArrayHelper::merge($docs_ids,DocumentPackageToDocumentBinder::getSlaveIds($package->id));    
        }
        
        $docs=Document::find()
        ->where(['id'=>$docs_ids,'active'=>'Y'])
        ->orderBy(['SORT'=>SORT_ASC])
        ->all();
        
        $html='';
        $html.="<ul class=\"list-group\">";
        $i=0;
        foreach ($docs as $doc)
        {
            $i++;
            $i_tag=Html::tag('span',$i.". ",["class"=>""]);
            $html.=Html::tag('li',$i_tag.$doc->name,["class"=>"list-group-item"]);
        }
        $html.="</ul>";
        return $html;
        //$this->asJson(['data'=>'wtf']);
    }
}