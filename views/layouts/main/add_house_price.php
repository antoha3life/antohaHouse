<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PaymentHouse */
/* @var $form ActiveForm */
?>
<div class="layouts-main-add_house_price">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'uuid') ?>
        <?= $form->field($model, 'user_id') ?>
        <?= $form->field($model, 'month_pay') ?>
        <?= $form->field($model, 'price_pay') ?>
        <?= $form->field($model, 'currency') ?>
        <?= $form->field($model, 'name_pay') ?>
        <?= $form->field($model, 'dop_pay') ?>
        <?= $form->field($model, 'date_pay') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- layouts-main-add_house_price -->
