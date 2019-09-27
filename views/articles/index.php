<?php
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\widgets\LinkPager;
Yii::$app->formatter->locale = 'ru-RU';
$this->title = 'Articles';
?>

    <h1><?= Html::encode($this->title) ?></h1>
    <ul>
        <?php foreach ($articles as $article): ?>
            <li>
                <?= Html::encode("Артикул: {$article->article} Brand (ID): {$article->brand->name}({$article->brand_id})") ?>
                Название: <?= $article->name ?>
                Дата добавления: <?= $article->date_add ?>
            </li>
        <?php endforeach; ?>
    </ul>

<?= LinkPager::widget(['pagination' => $pagination]) ?>