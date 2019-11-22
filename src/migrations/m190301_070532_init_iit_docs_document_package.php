<?php

use devskyfly\yiiModuleAdminPanel\migrations\helpers\contentPanel\EntityMigrationHelper;

/**
 * Class m190301_070532_init_iit_docs_document_package
 */
class m190301_070532_init_iit_docs_document_package extends EntityMigrationHelper
{
    public $table="iit_docs_document_package";
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $fields=$this->getFieldsDefinition();
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
        echo "m190301_070532_init_iit_docs_document_package cannot be reverted.\n";

        return false;
    }
    */
}
