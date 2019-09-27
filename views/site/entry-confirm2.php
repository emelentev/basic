<?php
use yii\helpers\Html;
Yii::$app->formatter->locale = 'ru-RU';
$this->title = 'Articles';
?>

    <h1><?= Html::encode($this->title) ?></h1>
    <p>Сделать контроллер возвращающий по запросу артикула - подробную информацию</p>
    <?php foreach ($brandInfo as $info): ?>
        <?= $info->info ?>
        <?= $info->info_warranty ?>
    <?php endforeach; ?>