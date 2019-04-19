<?php
namespace devskyfly\yiiModuleIitDocs\models\reportScript;

use devskyfly\yiiModuleAdminPanel\models\contentPanel\AbstractEntity;
use devskyfly\yiiModuleIitDocs\models\documentPackage\DocumentPackage;
use yii\helpers\ArrayHelper;

class ReportScript extends AbstractEntity
{
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
        $binderCls=ReportScriptToDocumentPackageBinder::class;

        $ids=$binderCls::getSlaveIdsByItem($this);
        $packages=DocumentPackage::find()->where(['id'=>$ids])->all();
        $result=ArrayHelper::merge($result,$packages);
        
        return $result;
    }
    
    public static function tableName()
    {
        return "iit_docs_report_script";
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
            'ReportScriptToDocumentPackageBinder'=>ReportScriptToDocumentPackageBinder::class
        ];
    }
    
    /**
     * {@inheritdoc}
     * @see devskyfly\yiiModuleAdminPanel\models\contentPanel\AbstractItem::selectListRoute()
     * Здесь прописывается роут к списку выбора
     */
    public static function selectListRoute()
    {
        return "/iit-docs/report-script/entity-select-list";
    }
    
}