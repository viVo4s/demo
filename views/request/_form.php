<?php

use app\models\Pay;
use app\models\Type;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Request $model */
/** @var yii\widgets\ActiveForm $form */
?>

<?php
$type = Type::find()
    ->select(['name'])
    ->indexBy('id')
    ->column();
?>

<?php
$pay = Pay::find()
    ->select(['name'])
    ->indexBy('id')
    ->column();
?>

<div class="request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->widget(yii\widgets\MaskedInput::class, ['mask' => '+7(999)-999-99-99']) ?>

    <?= $form->field($model, 'date')->widget(yii\widgets\MaskedInput::class, ['mask' => '99/99/9999'])?>

    <?= $form->field($model, 'time')->widget(yii\widgets\MaskedInput::class, ['mask' => '99:99']) ?>

    <?= $form->field($model, 'id_type')->dropDownList($type) ?>

    <?= $form->field($model, 'anothe')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_pay')->dropDownList($pay) ?>


    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
