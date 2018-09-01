<?php

use yii\db\Migration;

/**
 * Handles the creation of table `menutest`.
 */
class m180816_065130_create_menutest_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('menutest', [
            'id' => $this->primaryKey(),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'depth' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'title' => $this->string()->notNull(),
            'parent_id' => $this->integer()->defaultValue(0),
            'order' => $this->integer()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('menutest');
    }
}
