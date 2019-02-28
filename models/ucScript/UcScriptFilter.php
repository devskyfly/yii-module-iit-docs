<?php
namespace devskyfly\yiiModuleIitDocs\models\reportScript;

use devskyfly\yiiModuleAdminPanel\models\contentPanel\FilterInterface;
use devskyfly\yiiModuleAdminPanel\models\contentPanel\FilterTrait;
use devskyfly\yiiModuleIitDocs\models\ucScript\UcScript;

class UcScriptFilter extends UcScript implements FilterInterface
{
    use FilterTrait;
    
    public function rules()
    {
        return [[["data","active","create_date_time","change_date_time"],"string"]];
    }
}