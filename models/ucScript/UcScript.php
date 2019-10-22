<?php
namespace devskyfly\yiiModuleIitDocs\models\ucScript;

use devskyfly\yiiModuleAdminPanel\models\contentPanel\AbstractEntity;
use devskyfly\yiiModuleIitDocs\models\documentPackage\DocumentPackage;
use devskyfly\yiiModuleIitDocs\traits\DbTrait;
use yii\helpers\ArrayHelper;

class UcScript extends AbstractEntity
{
    use DbTrait;
    
    public function rules()
    {
        $rules=parent::rules();
        $newRules=[
            [['item_name'],"string"]
        ];
        $rules=ArrayHelper::merge($rules,$newRules);
        return $rules;
    }
    
    /**
     *
     * @return array
     */
    public function getDocumentsPackages()
    {
        $result=[];
        $binderCls=UcScriptToDocumentPackageBinder::class;
        
        $ids=$binderCls::getSlaveIdsByItem($this);
        $packages=DocumentPackage::find()->where(['id'=>$ids])->all();
        $result=ArrayHelper::merge($result,$packages);
        
        return $result;
    }
    
    public static function tableName()
    {
        return "iit_docs_uc_script";
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \devskyfly\yiiModuleContentPanel\models\contentPanel\AbstractSection::section()
     */
    protected static function sectionCls()
    {
        //Если иерархичность не требуется, то вместо названия класса можно передать null
        return Section::class;
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \devskyfly\yiiModuleContentPanel\models\contentPanel\AbstractItem::extensions()
     */
    public function extensions()
    {
        //Если расширений нет, то можно вернуть пустой массив
        return [];
    }

    public function binders()
    {
        return [
            'UcScriptToDocumentPackageBinder'=>UcScriptToDocumentPackageBinder::class
        ];
    }
    
    /**
     * {@inheritdoc}
     * @see devskyfly\yiiModuleAdminPanel\models\contentPanel\AbstractItem::selectListRoute()
     * Здесь прописывается роут к списку выбора
     */
    public static function selectListRoute()
    {
        return "/iit-docs/uc-scripts/entity-select-list";
    }
}