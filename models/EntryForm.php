<?php


namespace app\models;


use yii\base\Model;

class EntryForm extends Model
{
    public $brand_id;

    public function rules()
    {
        return [
            [['brand_id'], 'required'],
        ];
    }
}