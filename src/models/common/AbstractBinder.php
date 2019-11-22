<?php
namespace devskyfly\yiiModuleIitDocs\models\common;

use devskyfly\yiiModuleAdminPanel\models\contentPanel\AbstractBinder as Binder;
use devskyfly\yiiModuleIitDocs\traits\DbTrait;

abstract class AbstractBinder extends Binder
{
    use DbTrait;
    
    public static function tableName()
    {
        return 'iit_docs_binder';
    }
}