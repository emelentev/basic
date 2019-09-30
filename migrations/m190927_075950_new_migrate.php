<?php

use yii\db\Migration;

/**
 * Class m190927_075950_new_migrate
 */
class m190927_075950_new_migrate extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
//        $this->createTable('category', [
//            'id' => $this->primaryKey(),
//            'name' => $this->string()->notNull(),
//            'description' => $this->text(),
//            'published' => $this->boolean()->notNull(),
//            'parent_id' => $this->integer(),
//            'order' => $this->boolean()->notNull(),
//        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
//        $this->dropTable('category');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190927_075950_new_migrate cannot be reverted.\n";

        return false;
    }
    */
}
