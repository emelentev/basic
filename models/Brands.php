<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shop_brands".
 *
 * @property int $id
 * @property string $name
 * @property string $logo
 * @property string $info
 * @property string $info_warranty
 * @property int $active
 *
 * @property Articles[] $Articles
 */
class Brands extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_brands';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'logo', 'info', 'info_warranty', 'active'], 'required'],
            [['info', 'info_warranty'], 'string'],
            [['active'], 'integer'],
            [['name', 'logo'], 'string', 'max' => 255],
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
            'logo' => 'Logo',
            'info' => 'Info',
            'info_warranty' => 'Info Warranty',
            'active' => 'Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Articles::className(), ['brand_id' => 'id']);
    }
}
