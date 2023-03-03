<?php

use yii\helpers\Html;

$this->title = $model->filename;
$this->params['breadcrumbs'][] = ['label' => 'Uploads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<h1><?= Html::encode($this->title) ?></h1>

<figure class="figure">
    <?= Html::img("/uploads/$model->filename", [
        'class' => 'figure-img img-fluid',
        'alt' => $model->filename,
    ]) ?>
    <figcaption class="figure-caption"><?= $model->created_at ?></figcaption>
</figure>
