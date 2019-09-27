<?php
use yii\helpers\Html;
Yii::$app->formatter->locale = 'ru-RU';
$this->title = 'Articles';
?>

    <h1><?= Html::encode($this->title) ?></h1>
    <p>Сделать контроллер возвращающий по запросу id бренда все товары </p>
    <ul>
        <?php foreach ($articles as $article): ?>
            <li>
                <?= Html::encode("Артикул: {$article->article} Brand (ID): {$article->brand->name}({$article->brand_id})") ?>
                Название: <?= $article->name ?>
                Дата добавления: <?= $article->date_add ?>
            </li>
        <?php endforeach; ?>
    </ul>