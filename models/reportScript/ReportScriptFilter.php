<?php
namespace devskyfly\yiiModuleIitDocs\models\reportScript;

use devskyfly\yiiModuleAdminPanel\models\contentPanel\FilterInterface;
use devskyfly\yiiModuleAdminPanel\models\contentPanel\FilterTrait;

class ReportScriptFilter extends ReportScript implements FilterInterface
{
    use FilterTrait;
    
    public function rules()
    {
        return [[["data","active","create_date_time","change_date_time"],"string"]];
    }
}