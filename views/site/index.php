<?php

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Uploads';
$this->params['breadcrumbs'][] = $this->title;

?>

<h1><?= Html::encode($this->title) ?></h1>

<p>
    <?= Html::a('Upload →', ['upload'], ['class' => 'btn btn-success']) ?>
</p>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'pager' => [
        'class' => 'yii\bootstrap5\LinkPager',
    ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'label' => 'Preview',
            'format' => 'html',
            'value' => function ($model) {
                return Html::img("/uploads/$model->filename", [
                    'height' => '64px',
                    'alt' => $model->filename,
                ]);
            },
        ],
        'filename',
        'created_at',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view}',
        ],
    ],
]); ?>
