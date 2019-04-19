<?php
namespace devskyfly\yiiModuleIitDocs\models\ucScript;

use devskyfly\yiiModuleIitDocs\models\common\AbstractSection;

class Section extends AbstractSection
{
    /**
     *
     * {@inheritDoc}
     * @see \devskyfly\yiiModuleContentPanel\models\contentPanel\AbstractSection::entity()
     */
    public static function entityCls()
    {
        return UcScript::class;
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
        return "/iit-docs/uc-scripts/section-select-list";
    }
}
?>