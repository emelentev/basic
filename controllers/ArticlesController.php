<?php

namespace app\controllers;

use app\models\Brands;
use app\models\Articles;
use app\models\Category;
use yii\data\ActiveDataProvider;
use yii\helpers\VarDumper;
use yii\rest\ActiveController;

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
        $brand_id = \Yii::$app->request->get('brand_id');
        $brand_name = \Yii::$app->request->get('brand_name');
        $cat_id = \Yii::$app->request->get('cat_id');
        if ($cat_id){

            //
            $sql = "SELECT shop_articles_id FROM `shop_articles_category_lnk` WHERE `category_id`=:id";
            $ids = \Yii::$app->db->createCommand($sql)->bindValue(':id', $cat_id)->queryColumn();

            $articles_by_category = Articles::find()
                ->where(['id' => $ids])
                ->asArray()->all();

            VarDumper::dump($articles_by_category);die(" Die");
        }
        if ($brand_name){
            $idBrand = Brands::find()->where(['name' => $brand_name])->one()->id;
        }
        $query = Articles::find()->with('brand');
        if ($brand_id){
            $query->where(['brand_id' => $brand_id]);
        }
        if ($brand_name){
            $query->where(['brand_id' => $idBrand]);
        }
        return new ActiveDataProvider([
           'query' => $query,
        ]);
    }

    public function actionBrandByArticle($article)
    {
        $queryArticles = Articles::find();
        $queryBrands = Brands::find();

        $articles = $queryArticles
            ->select('article, brand_id')
            ->orderBy('id')
            ->where(['article' => $article])
            ->all();
        foreach ($articles as $article){
            $brandIdForArticle[] = $article->brand_id;
        };
        $brandInfo = $queryBrands->orderBy('id')
            ->where(['id' => $brandIdForArticle])
            ->all();
        return $brandInfo;
    }
}