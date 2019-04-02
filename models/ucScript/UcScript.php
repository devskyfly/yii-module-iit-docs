<?php
namespace devskyfly\yiiModuleIitDocs\models\ucScript;

use devskyfly\yiiModuleAdminPanel\models\contentPanel\AbstractEntity;
use devskyfly\yiiModuleIitDocs\models\documentPackage\DocumentPackage;
use yii\helpers\ArrayHelper;

class UcScript extends AbstractEntity
{
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
    
    /**
     * {@inheritdoc}
     * @see devskyfly\yiiModuleAdminPanel\models\contentPanel\AbstractItem::selectListRoute()
     * Здесь прописывается роут к списку выбора
     */
    public static function selectListRoute()
    {
        return "/iit-docs/uc-script/entity-select-list";
    }
}