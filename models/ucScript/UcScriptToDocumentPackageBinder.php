<?php
namespace devskyfly\yiiModuleIitDocs\models\ucScript;

use devskyfly\yiiModuleIitDocs\models\common\AbstractBinder;
use devskyfly\yiiModuleIitDocs\models\documentPackage\DocumentPackage;
use devskyfly\yiiModuleIitDocs\models\ucScript\UcScript;

class UcScriptToDocumentPackageBinder extends AbstractBinder
{
    protected static function slaveCls()
    {
        return DocumentPackage::class;
    }

    protected static function masterCls()
    {
        return UcScript::class;
    }

    
}