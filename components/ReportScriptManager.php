<?php
namespace devskyfly\yiiModuleIitDocs\components;

use devskyfly\yiiModuleIitDocs\models\reportScript\Section;

class ReportScriptManager extends AbstractScriptManager
{
    public static function sectionCls()
    {
        return Section::class;
    }  
}