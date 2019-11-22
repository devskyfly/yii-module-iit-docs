<?php
namespace devskyfly\yiiModuleIitDocs\models\documentPackage;

use devskyfly\yiiModuleAdminPanel\models\contentPanel\FilterInterface;
use devskyfly\yiiModuleAdminPanel\models\contentPanel\FilterTrait;

class DocumentPackageFilter extends DocumentPackage implements FilterInterface
{
    use FilterTrait;
    
    public function rules()
    {
        return [[["data","active","create_date_time","change_date_time"],"string"]];
    }
}