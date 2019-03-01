<?php

use devskyfly\yiiModuleAdminPanel\migrations\helpers\contentPanel\EntityMigrationHelper;
use yii\db\Migration;

/**
 * Class m190301_070504_init_iit_docs_report_script
 */
class m190301_070504_init_iit_docs_report_script extends EntityMigrationHelper
{
    public $table="iit_docs_report_script";
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $fields=$this->getFieldsDefinition();
        $fields['item_name']="TEXT";
        $this->createTable($this->table,$fields);
    }
    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->table);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190301_070504_init_iit_docs_report_script cannot be reverted.\n";

        return false;
    }
    */
}
