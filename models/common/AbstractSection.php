<?php
namespace devskyfly\yiiModuleIitDocs\models\common;


use devskyfly\yiiModuleAdminPanel\models\contentPanel\AbstractSection as Section;

abstract class AbstractSection extends Section
{
    public static function tableName()
    {
        return 'iit_docs_section';
    }
}