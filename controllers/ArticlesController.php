<?php


namespace app\controllers;


use app\models\Brands;
use app\models\Entry2Form;
use yii\data\ActiveDataProvider;
use yii\helpers\VarDumper;
use yii\rest\ActiveController;
use yii\data\Pagination;
use app\models\Articles;

class ArticlesController extends ActiveController
{
    public $modelClass = 'app\models\Articles';

    protected function verbs()
    {
        return [
            'index' => ['GET', 'HEAD'],
            'view' => ['GET', 'HEAD'],
            'create' => ['POST'],
            'update' => ['PUT', 'PATCH'],
            'delete' => ['DELETE'],
            'entry' => ['GET'],
        ];
    }

    public function actions()
    {
        $actions = parent::actions();

        // отключить действия "delete" и "create"
        unset($actions['delete'], $actions['create']);

        // настроить подготовку провайдера данных с помощью метода "prepareDataProvider()"
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

        //unset($actions['index']);

        return $actions;
    }

    public function prepareDataProvider()
    {
        $query = Articles::find()->where(['brand_id' => 5]);
       return new ActiveDataProvider([
           'query' => $query,
       ]);
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

    public function actionEntry2($article)
    {
        $queryArticles = Articles::find();
        $queryBrands = Brands::find();

        $articles = $queryArticles->orderBy('id')
            ->where(['article' => $article])
            ->offset(0)
            ->limit('all')
            ->all();
        foreach ($articles as $article){
            $brandIdForArticle = $article->brand_id;
        };
        $brandInfo = $queryBrands->orderBy('id')
            ->where(['id' => $brandIdForArticle])
            ->offset(0)
            ->limit('all')
            ->all();
        return $brandInfo;
    }
}