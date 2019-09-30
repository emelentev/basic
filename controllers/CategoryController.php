<?php


namespace app\controllers;

use app\models\Category;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;

class CategoryController extends ActiveController
{
    public $modelClass = 'app\models\Category';

    protected function verbs()
    {
        return [
            'index' => ['GET', 'HEAD'],
            'view' => ['GET', 'HEAD'],
            'create' => ['POST'],
            'update' => ['PUT', 'PATCH'],
            'delete' => ['DELETE'],
        ];
    }
    public function actions()
    {
        $actions = parent::actions();
        // отключить действия "delete" и "create"
        unset($actions['delete'], $actions['create']);
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }
    public function prepareDataProvider()
    {
        $query = Category::find();
        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }
}