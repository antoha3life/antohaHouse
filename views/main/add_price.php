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
        <?= \app\widgets\Alert::widget() ?>

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
            )
        ->label('Месяц');
        ?>
        <?= $form->field($model, 'currency')
        ->dropDownList([
            'USD' => 'USD Доллар США',
            'BYN' => 'BYN Белорусский рубль'
            ],
            [
                'prompt' => 'Выбрать валюту'
            ])
        ->label('Валюта оплаты');
        ?>
        <?=
        $form->field($model, 'price_pay')
        ->label('Указать цену');
        ?>
        <?= $form->field($model, 'dop_pay')->label('Дополнительные траты. Только суммы через , (20, 30)'); ?>
        <!--<div class="form-group">
            <a style="cursor: pointer;" id="btn_add" onclick="antohaJS.showFirstInput()">Добавить дополнительные траты</a>
            <span id="count_input_dop"></span>
        </div>-->
        <?=
        $form->field($model, 'name_pay')
        ->label('Наименование услуги. Что оплачиваем');
        ?>
        <div class="form-group">
            <?= Html::submitButton('send', [
                'class' => 'btn btn-primary'
            ]) ?>
        </div>
        <?php
        ActiveForm::end();
        ?>
    </div>
    <div class="col-lg-7">
        <?php
        //$kurs = @simplexml_load_file('http://www.nbrb.by/Services/XmlExRates.aspx');
        ?>
    </div>
</div>
