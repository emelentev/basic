<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $published
 * @property int $parent_id
 * @property int $order
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['published', 'parent_id', 'order'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'published' => 'Published',
            'parent_id' => 'Parent ID',
            'order' => 'Order',
        ];
    }
    public function getItems()
    {
        return $this->hasMany(Articles::className(), ['id' => 'category_id'])
            ->viaTable('shop_articles_category_lnk', ['shop_articles_id' => 'id']);
    }
}
