<?php
namespace devskyfly\yiiModuleIitDocs\models\documentPackage;

use devskyfly\yiiModuleIitDocs\models\common\AbstractBinder;
use devskyfly\yiiModuleIitDocs\models\document\Document;

class DocumentPackageToDocumentBinder extends AbstractBinder
{
    protected static function slaveCls()
    {
        return Document::class;
    }

    protected static function masterCls()
    {
        return DocumentPackage::class;
    }
}