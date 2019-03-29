<?php
namespace devskyfly\yiiModuleIitDocs\components;

use devskyfly\php56\core\Cls;
use devskyfly\php56\types\Obj;
use devskyfly\php56\types\Vrbl;
use devskyfly\yiiModuleAdminPanel\models\contentPanel\AbstractSection;
use devskyfly\yiiModuleIitDocs\models\reportScript\Section as ReportSection;
use devskyfly\yiiModuleIitDocs\models\ucScript\Section as UcSection;
use yii\base\BaseObject;

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
    
    public static function getChildsRecursivly(AbstractSection $section=null)
    {
        $result=[];
        $childs=static::getChilds($section);
        foreach ($childs as $child){
            $result[]=['item'=>$child, 'childs'=>static::getChildsRecursivly($child)];
        }
        return $result;
    }
    
    public static function getChildsRecursivlyInJson(AbstractSection $section=null)
    {
        $result=[];
        $childs=static::getChilds($section);
        foreach ($childs as $child){
            $result[]=['name'=>$child->name, 'id'=>$child->id, 'children'=>static::getChildsRecursivlyInJson($child)];
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
}