<?php
namespace devskyfly\yiiModuleIitDocs\models\common;


use devskyfly\yiiModuleAdminPanel\models\contentPanel\AbstractSection as Section;
use devskyfly\yiiModuleIitDocs\traits\DbTrait;

abstract class AbstractSection extends Section
{
    use DbTrait;
    
    public static function tableName()
    {
        return 'iit_docs_section';
    }
}