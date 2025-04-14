<?php

use app\models\Pay;
use app\models\Status;
use app\models\Type;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Request $model */
/** @var yii\widgets\ActiveForm $form */
?>

<?php
$status = Status::find()
    ->select(['name'])
    ->indexBy('id')
    ->column();
?>

<div class="request-form">

    <?= $form->field($model, 'id_status')->dropDownList($status) ?>


    <div class="form-group">
        <?= Html::submitButton('обнвить статус', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
