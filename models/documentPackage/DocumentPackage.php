<?php
namespace devskyfly\yiiModuleIitDocs\models\documentPackage;

use devskyfly\yiiModuleAdminPanel\models\contentPanel\AbstractEntity;

class DocumentPackage extends AbstractEntity
{
    public static function tableName()
    {
        return "iit_docs_document_package";
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \devskyfly\yiiModuleContentPanel\models\contentPanel\AbstractSection::section()
     */
    public static function sectionCls()
    {
        //Если иерархичность не требуется, то вместо названия класса можно передать null
        return null;
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
        return "/iit-docs/documents-packages/entity-select-list";
    }
}