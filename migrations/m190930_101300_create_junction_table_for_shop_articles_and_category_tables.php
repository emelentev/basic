<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%shop_articles_category}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%shop_articles}}`
 * - `{{%category}}`
 */
class m190930_101300_create_junction_table_for_shop_articles_and_category_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%shop_articles_category}}', [
            'shop_articles_id' => $this->integer(),
            'category_id' => $this->integer(),
            'PRIMARY KEY(shop_articles_id, category_id)',
        ]);

        // creates index for column `shop_articles_id`
        $this->createIndex(
            '{{%idx-shop_articles_category-shop_articles_id}}',
            '{{%shop_articles_category}}',
            'shop_articles_id'
        );

        // add foreign key for table `{{%shop_articles}}`
        $this->addForeignKey(
            '{{%fk-shop_articles_category-shop_articles_id}}',
            '{{%shop_articles_category}}',
            'shop_articles_id',
            '{{%shop_articles}}',
            'id',
            'CASCADE'
        );

        // creates index for column `category_id`
        $this->createIndex(
            '{{%idx-shop_articles_category-category_id}}',
            '{{%shop_articles_category}}',
            'category_id'
        );

        // add foreign key for table `{{%category}}`
        $this->addForeignKey(
            '{{%fk-shop_articles_category-category_id}}',
            '{{%shop_articles_category}}',
            'category_id',
            '{{%category}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%shop_articles}}`
        $this->dropForeignKey(
            '{{%fk-shop_articles_category-shop_articles_id}}',
            '{{%shop_articles_category}}'
        );

        // drops index for column `shop_articles_id`
        $this->dropIndex(
            '{{%idx-shop_articles_category-shop_articles_id}}',
            '{{%shop_articles_category}}'
        );

        // drops foreign key for table `{{%category}}`
        $this->dropForeignKey(
            '{{%fk-shop_articles_category-category_id}}',
            '{{%shop_articles_category}}'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            '{{%idx-shop_articles_category-category_id}}',
            '{{%shop_articles_category}}'
        );

        $this->dropTable('{{%shop_articles_category}}');
    }
}
