<?php
namespace devskyfly\yiiModuleIitDocs\models\reportScript;

use devskyfly\yiiModuleIitDocs\models\common\AbstractBinder;
use devskyfly\yiiModuleIitDocs\models\documentPackage\DocumentPackage;

class ReportScriptToDocumentPackageBinder extends AbstractBinder
{
    protected static function slaveCls()
    {
        return DocumentPackage::class;
    }

    protected static function masterCls()
    {
        return ReportScript::class;
    }

}