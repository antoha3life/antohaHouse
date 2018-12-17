<?php
/**
 * Created by PhpStorm.
 * User: varik
 * Date: 16.12.2018
 * Time: 22:49
 */

use \yii\helpers\Html;
use \yii\widgets\ActiveForm;
?>
<div class="row">
    <div class="col-lg-5">
        <?php
        $form = ActiveForm::begin([
            'id' => 'add_price_house',
            'options' => [
                    'class' => 'form-horizontal'
            ]
        ]);
        ?>
        <input name="PaymentHouse[uuid]" type="hidden" value="<?= GenerateUUID() ?>">
        <div class="form-group">
            <label class="control-label" for="paymenthouse-month_pay">Текущий год</label>
            <input value="<?= date('Y')?>" class="form-control" readonly>
        </div>
        <?=
        $form->field($model, 'month_pay')
            ->dropDownList(
                Yii::$app->month->getDataMonth('ru'),
                [
                    'prompt' => 'Выбрать месяц'
                ]
            );
        ?>
        <?= $form->field($model, 'price_pay'); ?>
        <?= $form->field($model, 'currency'); ?>
        <?= $form->field($model, 'dop_pay')->label('Дополнительные траты. Только суммы через ,'); ?>
        <!--<div class="form-group">
            <a style="cursor: pointer;" id="btn_add" onclick="antohaJS.showFirstInput()">Добавить дополнительные траты</a>
            <span id="count_input_dop"></span>
        </div>-->
        <?= $form->field($model, 'name_pay'); ?>
        <div class="form-group">
            <?= Html::submitButton('send') ?>
        </div>
        <?php
        ActiveForm::end();
        ?>
    </div>
    <div class="col-lg-7"></div>
</div>
