<?php
namespace devskyfly\yiiModuleIitDocs\components;

use devskyfly\php56\types\Vrbl;
use devskyfly\yiiModuleAdminPanel\models\contentPanel\AbstractSection;
use devskyfly\yiiModuleIitDocs\models\reportScript\Section as ReportSection;
use devskyfly\yiiModuleIitDocs\models\ucScript\Section as UcSection;
use yii\base\BaseObject;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use devskyfly\yiiModuleIitDocs\models\reportScript\ReportScriptToDocumentPackageBinder;
use devskyfly\yiiModuleIitDocs\models\ucScript\UcScript;
use devskyfly\yiiModuleIitDocs\models\ucScript\UcScriptToDocumentPackageBinder;
use devskyfly\yiiModuleIitDocs\models\documentPackage\DocumentPackage;
use devskyfly\yiiModuleIitDocs\models\reportScript\ReportScript;

abstract class AbstractScriptManager extends BaseObject
{
    /**
     * return AbstractSection
     */
    abstract public static function sectionCls();
    
    /**
     * return AbstractSection
     */
    protected function getSectionCls()
    {
        $cls=static::sectionCls();
        if(
            ($cls!=UcSection::class)
            &&($cls!=ReportSection::class)
            ){
                throw new \InvalidArgumentException('Varible $cls is not subclass of '.UcSection::class.' and '.ReportSection::class.' type');
        }
        return $cls;
    }
    
    public static function getTree()
    {
        return static::getChilds(null);
    }
    
    /**
     * 
     * @param number $id
     * @return UcSection|ReportSection|null
     */
    public static function getById($id)
    {
        $cls=static::getSectionCls();
        return $cls::find()->andWhere('id')->one();
    }
    
    /**
     * 
     * @param AbstractSection $section
     * @return AbstractSection|null
     */
    public static function getParent(AbstractSection $section)
    {
        return $section::find()->andWhere(['id'=>$section->__id])->one();
    }
    
    /**
     * 
     * @param AbstractSection $section
     * @return AbstractSection[]
     */
    public static function getChilds(AbstractSection $section=null)
    {
        $cls=static::getSectionCls();
        if(Vrbl::isNull($section)){
            return $cls::find()->andWhere(['__id'=>null])->all();
        }else{
            return $cls::find()->andWhere(['__id'=>$section->id])->all();
        }
    }
    
    /**
     * 
     * @param AbstractSection $section
     * @return \devskyfly\yiiModuleAdminPanel\models\contentPanel\AbstractSection[][]|NULL[][][][]|\devskyfly\yiiModuleAdminPanel\models\contentPanel\AbstractSection[][][][]
     */
    public static function getChildsRecursivly(AbstractSection $section=null)
    {
        $result=[];
        $childs=static::getChilds($section);
        foreach ($childs as $child){
            $result[]=['item'=>$child, 'childs'=>static::getChildsRecursivly($child)];
        }
        return $result;
    }
    
    /**
     * 
     * @param AbstractSection $section
     * @return []
     */
    public static function getChildsRecursivlyForChartOrg(AbstractSection $section=null)
    {
        $result=[];
        
        $childs=static::getChilds($section);
        foreach ($childs as $child){
            
            if(static::getSectionCls()==ReportSection::class){
                $route=Url::toRoute(['/iit-docs/report-scripts/','parent_section_id'=>$child->id]);
            }elseif(static::getSectionCls()==UcSection::class){
                $route=Url::toRoute(['/iit-docs/uc-scripts/','parent_section_id'=>$child->id]);
            }
            
            $packages=[];
            $entities=$child->getEntities();            
            foreach ($entities as $entity){
                $packages=ArrayHelper::merge($packages,$entity->getDocumentsPackages());
            }
            
            
            $html_packages='<ul>';
            foreach ($packages as $package){
                $package_route=Url::toRoute(['/iit-docs/documents-packages/entity-edit','entity_id'=>$package['id']]);
                $html_packages.="<li><a href='{$package_route}' target='_blank'>{$package->active} {$package->name}</a></li>";
            }
            $html_packages.='</ul>';
            
            $result[]=[
                'name'=>"<a href=\"{$route}\" target='_blank' section_id=\"{$child->id}\">{$child->active} {$child->name}</a>", 
                'content'=>$html_packages,
                'id'=>$child->id, 
                'children'=>static::getChildsRecursivlyForChartOrg($child)
            ];
        }
        
        
        if(Vrbl::isNull($section)){
            
            if(static::getSectionCls()==ReportSection::class){
                $entity=ReportScript::class;
                $entities=$entity::find()->where(['_section__id'=>null])->all();
                $route=Url::toRoute(['/iit-docs/report-scripts/']);
            }elseif(static::getSectionCls()==UcSection::class){
                $entity=UcScript::class;
                $entities=$entity::find()->where(['_section__id'=>null])->all();
                $route=Url::toRoute(['/iit-docs/uc-scripts/']);
            }

            $packages=[];

            foreach ($entities as $entity){
                $packages=ArrayHelper::merge($packages,$entity->getDocumentsPackages());
            }          
            
            $html_packages='<ul>';
            foreach ($packages as $package){
                $route=Url::toRoute(['/iit-docs/documents-packages/entity-edit','entity_id'=>$package['id']]);
                $html_packages.="<li><a href='{$route}' target='_blank'>{$package->active} {$package->name}</a></li>";
            }
            $html_packages.='</ul>';
            
            $result=[
                'name'=>"<a href=\"{$route}\" target='_blank'>root</a>",
                'content'=>$html_packages,
                'id'=>$child->id,
                'children'=>$result
                ];
        }
        
        return $result;
    }
    
    /**
     * 
     * @param AbstractSection $section
     * @return AbstractSection[]
     */
    public static function getRelatives(AbstractSection $section)
    {
        $parent=static::getParent($section);
        return static::getChilds($parent);
    }
    
    /**
     * 
     * @param AbstractSection $section
     * @return AbstractSection[]
     */
    public static function getChain(AbstractSection $section)
    {
        $result=[];
        $result[]=$section;
        
        while($parent=static::getParent($section)){
            
            $section=$parent;
            $result[]=$section;
        }
        
        return array_reverse($result);
    }
    
    /**
     * @deprecated
     * @param AbstractSection $model
     * @return array|\yii\helpers\UnsetArrayValue|\yii\helpers\ReplaceArrayValue|mixed
     */
    public static function getSubPackages(AbstractSection $model=null)
    {
        $result=[];
        $entities=$model->getEntities();
        
        $sectionCls=static::getSectionCls();
        
        if($sectionCls==UcSection::class){
            $binderCls=UcScriptToDocumentPackageBinder::class;
        }
        elseif ($sectionCls==ReportSection::class){
            $binderCls=ReportScriptToDocumentPackageBinder::class;
        }else{
            throw new \OutOfRangeException('Varible $binderCls is of range ('.UcScriptToDocumentPackageBinder::class.','.ReportScriptToDocumentPackageBinder::class.').');
        }
        
        foreach ($entities as $entity){
            $ids=$binderCls::getSlaveIdsByItem($entity);
            $packages=DocumentPackage::find()->where(['id'=>$ids])->all();
            $result=ArrayHelper::merge($result,$packages);
        }
        
        return $result;
    }
}