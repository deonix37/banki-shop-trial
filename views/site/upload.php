<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Upload';
$this->params['breadcrumbs'][] = $this->title;

?>

<?php $form = ActiveForm::begin() ?>
    <?= $form->field($model, 'files[]')->fileInput([
        'multiple' => true,
        'accept' => 'image/*',
    ]) ?>

    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end() ?>
