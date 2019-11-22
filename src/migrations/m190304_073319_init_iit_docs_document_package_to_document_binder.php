<?php

use devskyfly\yiiModuleAdminPanel\migrations\helpers\contentPanel\BinderMigrationHelper;

/**
 * Class m190304_073319_init_iit_docs_document_package_to_document_binder
 */
class m190304_073319_init_iit_docs_document_package_to_document_binder extends BinderMigrationHelper
{
    public $table="iit_docs_binder"; 
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $fields=$this->getFieldsDefinition();
        $this->createTable($this->table, $fields);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn($this->table);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190304_073319_init_iit_docs_document_package_to_document_binder cannot be reverted.\n";

        return false;
    }
    */
}
