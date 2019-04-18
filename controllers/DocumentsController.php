<?php
namespace devskyfly\yiiModuleIitDocs\controllers;

use devskyfly\php56\types\Obj;
use devskyfly\yiiModuleAdminPanel\controllers\contentPanel\AbstractContentPanelController;
use devskyfly\yiiModuleAdminPanel\widgets\contentPanel\ItemSelector;
use devskyfly\yiiModuleIitDocs\models\document\Document;
use devskyfly\yiiModuleIitDocs\models\document\DocumentFilter;
use devskyfly\yiiModuleIitDocs\models\document\Section;

class DocumentsController extends AbstractContentPanelController
{
    /**
     *
     * {@inheritDoc}
     * @see \devskyfly\yiiModuleAdminPanel\controllers\contentPanel\AbstractContentPanelController::sectionItem()
     */
    public static function sectionCls()
    {
        //Если иерархичность не требуется, товместо названия класса можно передать null
        return Section::class;
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \devskyfly\yiiModuleAdminPanel\controllers\contentPanel\AbstractContentPanelController::entityItem()
     */
    public static function entityCls()
    {
        return Document::class;
    }
    
    /**
     * @return \devskyfly\yiiModuleAdminPanel\models\contentPanel\AbstractItem | null
     */
    public static function entityFilterCls()
    {
        return DocumentFilter::class;
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \devskyfly\yiiModuleAdminPanel\controllers\contentPanel\AbstractContentPanelController::entityEditorViews()
     */
    public function entityEditorViews()
    {
        return function($form,$item)
        {
            return [
                [
                    "label"=>"main",
                    "content"=>
                    $form->field($item,'name')
                    .ItemSelector::widget([
                        "form"=>$form,
                        "master_item"=>$item,
                        "slave_item_cls"=>$item::getSectionCls(),
                        "property"=>"_section__id"
                    ])
                    .$form->field($item,'create_date_time')
                    .$form->field($item,'change_date_time')
                    .$form->field($item,'sort')
                    .$form->field($item,'active')->checkbox(['value'=>'Y','uncheck'=>'N','checked'=>$item->active=='Y'?true:false])
                    .$form->field($item,'info_text')->textarea(['rows'=>5])
                    
                ]
            ];
        };
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \devskyfly\yiiModuleAdminPanel\controllers\contentPanel\AbstractContentPanelController::sectionEditorItems()
     */
    public function sectionEditorViews()
    {
        return function($form,$item)
        {
            
            return [
                [
                    "label"=>"main",
                    "content"=>
                    $form->field($item,'name')
                    .ItemSelector::widget([
                        "form"=>$form,
                        "master_item"=>$item,
                        "slave_item_cls"=>Obj::getClassName($item),
                        "property"=>"__id"
                    ])
                    .$form->field($item,'create_date_time')
                    .$form->field($item,'change_date_time')
                    .$form->field($item,'sort')
                    .$form->field($item,'active')->checkbox(['value'=>'Y','uncheck'=>'N','checked'=>$item->active=='Y'?true:false])
                    
                ]
            ];
        };
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \devskyfly\yiiModuleAdminPanel\controllers\contentPanel\AbstractContentPanelController::itemLabel()
     */
    public function itemLabel()
    {
        return "Документы";
    }
}
?>