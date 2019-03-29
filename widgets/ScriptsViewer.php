<?php
namespace devskyfly\yiiModuleIitDocs\widgets;

use yii\base\Widget;
use devskyfly\yiiModuleIitDocs\components\UcScriptManager;

class ScriptsViewer extends Widget
{
    //public $sectionCls;
    
    protected $data=[];
    
    public function init()
    {
        parent::init();
        
        $this->formData();
    }
    
    public function run()
    {
        $data=$this->data;
        return $this->render('script-viewer',compact("data"));
    }
    
    protected function formData()
    {
        $this->data=UcScriptManager::getChildsRecursivlyInJson(null);
    }
}