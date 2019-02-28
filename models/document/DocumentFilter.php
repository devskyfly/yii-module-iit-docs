<?php
namespace devskyfly\yiiModuleIitDocs\models\document;

use devskyfly\yiiModuleAdminPanel\models\contentPanel\FilterInterface;
use devskyfly\yiiModuleAdminPanel\models\contentPanel\FilterTrait;

class DocumentFilter extends Document implements FilterInterface
{
    use FilterTrait;
    
    public function rules()
    {
        return [[["data","active","create_date_time","change_date_time"],"string"]];
    }
}