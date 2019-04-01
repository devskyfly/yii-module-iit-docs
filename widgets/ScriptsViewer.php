<?php
namespace devskyfly\yiiModuleIitDocs\widgets;

use yii\base\Widget;
use devskyfly\yiiModuleIitDocs\components\ReportScriptManager;
use devskyfly\yiiModuleIitDocs\components\UcScriptManager;

class ScriptsViewer extends Widget
{

    const MODE_UC = 'uc';
    const MODE_REPORT = 'report';

    public $mode = 'uc';

    protected $scriptsTree = [];

    protected $modeList = [
        'uc',
        'report'
    ];

    public function init()
    {
        parent::init();
        if(!in_array($this->mode, $this->modeList)){
            throw new \OutOfRangeException("Mode value is not 'uc' or 'report' value.");
        }
        $this->initTree();
    }

    public function run()
    {
        $mode=$this->mode;
        $scriptsTree = $this->scriptsTree;
        return $this->render('script-viewer', compact("scriptsTree","mode"));
    }

    protected function initTree()
    {
        if ($this->mode ==static::MODE_UC) {
            $this->scriptsTree = UcScriptManager::getChildsRecursivlyInJson(null);
        }else{
            $this->scriptsTree = ReportScriptManager::getChildsRecursivlyInJson(null);
        }
    }
}