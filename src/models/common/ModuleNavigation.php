<?php
namespace devskyfly\yiiModuleIitDocs\models\common;

use devskyfly\yiiModuleAdminPanel\models\common\AbstractModuleNavigation;

class ModuleNavigation extends AbstractModuleNavigation
{
    protected function moduleRoute()
    {
        return "/iit-docs/";
    }

    protected function moduleList()
    {
        return
        [
            ['name'=>'Сценарии "УЦ"','route'=>'/iit-docs/uc-scripts/'],
            ['name'=>'Сценарии "Отчетность"','route'=>'/iit-docs/report-scripts/'],
            ['name'=>'Документы','route'=>'/iit-docs/documents/'],
            ['name'=>'Пакеты документов','route'=>'/iit-docs/documents-packages/']
        ];
    }

    protected function moduleName()
    {
        return 'iit-docs';
    }

}