<?php

use devskyfly\yiiModuleAdminPanel\migrations\helpers\contentPanel\EntityMigrationHelper;

/**
 * Class m190301_070445_init_iit_docs_document
 */
class m190301_070445_init_iit_docs_document extends EntityMigrationHelper
{
    public $table="iit_docs_document";
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $fields=$this->getFieldsDefinition();
        $fields['info_text']="TEXT";
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
        echo "m190301_070445_init_iit_docs_document cannot be reverted.\n";

        return false;
    }
    */
}
