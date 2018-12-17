<?php

/**
 * @var $this yii\web\View
 */

$this->title = Yii::$app->name;

?>

<div class="row">
    <div class="col-md-12">
        <h1><?= $this->title ?> <span style="font-size: 16px; float: right;">всего заплатил за хату <strong><?= $count_all_pay['price_count'] ?>$</strong></span></h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <table class="table table-hover">
            <thead> <tr> <th>#</th> <th>Месяц</th> <th>Цена</th> <th>Валюта</th><th>Оплата</th><th>Дата</th> </tr> </thead>
            <tbody>
            <?php foreach ($all_pays as $all_pay): ?>
                <tr>
                    <th><?= $all_pay['id']?></th>
                    <td><?= $all_pay['month_pay']?></td>
                    <td><?= $all_pay['price_pay']?></td>
                    <td><?= $all_pay['currency']?></td>
                    <td><?= $all_pay['name_pay']?></td>
                    <td><?= $all_pay['date_pay']?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
