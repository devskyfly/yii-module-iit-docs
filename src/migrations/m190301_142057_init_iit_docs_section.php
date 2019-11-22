<?php

use devskyfly\yiiModuleAdminPanel\migrations\helpers\contentPanel\SectionMigrationHelper;

/**
 * Class m190301_142057_init_iit_docs_section
 */
class m190301_142057_init_iit_docs_section extends SectionMigrationHelper
{
    public $table="iit_docs_section";
    
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
        echo "m190301_142057_init_iit_docs_section cannot be reverted.\n";

        return false;
    }
    */
}
