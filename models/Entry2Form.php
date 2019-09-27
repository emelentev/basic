<?php


namespace app\models;


use yii\base\Model;

class Entry2Form extends Model
{
    public $article;

    public function rules()
    {
        return [
            [['article'], 'required'],
        ];
    }
}