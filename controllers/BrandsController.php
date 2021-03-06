<?php

namespace app\controllers;

use app\models\Brands;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;

class BrandsController extends ActiveController
{

    public $modelClass = 'app\models\Brands';

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
        $query = Brands::find();
        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }
}
