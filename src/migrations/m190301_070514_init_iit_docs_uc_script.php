<?php

use devskyfly\yiiModuleAdminPanel\migrations\helpers\contentPanel\EntityMigrationHelper;

/**
 * Class m190301_070514_init_iit_docs_uc_script
 */
class m190301_070514_init_iit_docs_uc_script extends EntityMigrationHelper
{
    public $table="iit_docs_uc_script";
    
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
        echo "m190301_070514_init_iit_docs_uc_script cannot be reverted.\n";

        return false;
    }
    */
}
