<?php
namespace devskyfly\yiiModuleIitDocs\components;

use devskyfly\yiiModuleIitDocs\models\ucScript\Section;

class UcScriptManager extends AbstractScriptManager
{
    public static function sectionCls()
    {
        return Section::class;
    }
}