<?php
namespace devskyfly\yiiModuleIitDocs\models\document;

use devskyfly\php56\types\Str;
use devskyfly\yiiModuleAdminPanel\models\contentPanel\AbstractEntity;
use yii\helpers\ArrayHelper;

class Document extends AbstractEntity
{
    public function rules()
    {
        $rules=parent::rules();
        $new_rules=[['item_info'],'string'];
        $rules=ArrayHelper::merge($rules,$new_rules);
        return $rules;
    }
    
    public static function tableName()
    {
        return "iit_docs_document";
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
        return [
            
        ];
    }
    
    /**
     * {@inheritdoc}
     * @see devskyfly\yiiModuleAdminPanel\models\contentPanel\AbstractItem::selectListRoute()
     * Здесь прописывается роут к списку выбора
     */
    public static function selectListRoute()
    {
        return "/iit-docs/documents/entity-select-list";
    }

    public function __toString()
    {
        return Str::toString($this->id);
    }
}