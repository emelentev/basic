<?php

namespace app\controllers;

use app\models\Articles;
use app\models\Brands;
use app\models\EntryForm;
use app\models\Entry2Form;
use Yii;
use yii\filters\AccessControl;
use yii\rest\ActiveController;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends ActiveController
{
    public $modelClass = 'app\models\Entry2Form';
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSay($message = 'Привет')
    {
        return $this->render('say', ['message' => $message]);
    }

    public function actionEntry1($brand_id)
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
        $model = new Entry2Form();
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
