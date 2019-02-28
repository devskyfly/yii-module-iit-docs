<?php
namespace devskyfly\yiiModuleIitDocs\models\common;

use devskyfly\yiiModuleAdminPanel\models\contentPanel\AbstractBinder as Binder;

abstract class AbstractBinder extends Binder
{
    public static function tableName()
    {
        return 'iit_docs_binder';
    }
}