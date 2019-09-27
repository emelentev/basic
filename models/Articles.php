<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shop_articles".
 *
 * @property int $id
 * @property int $article
 * @property int $brand_id
 * @property string $name
 * @property string $date_add
 *
 * @property Brands $brand
 */
class Articles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_articles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['article', 'brand_id', 'name', 'date_add'], 'required'],
            [['article', 'brand_id'], 'integer'],
            [['date_add'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['article'], 'unique'],
            [['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brands::className(), 'targetAttribute' => ['brand_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'article' => 'Article',
            'brand_id' => 'Brand ID(Brand)',
            'name' => 'Name',
            'date_add' => 'Date Add',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brands::className(), ['id' => 'brand_id']);
    }

    public function actionEntry($brand_id)
    {
        $query = Articles::find();
        $articles = $query->orderBy('id')
            ->where(['brand_id' => $brand_id])
            ->offset(0)
            ->limit('all')
            ->all();
        return $articles;
    }
}
