<?php
/**
 * Created by PhpStorm.
 * User: varik
 * Date: 14.01.2019
 * Time: 23:05
 */
use \yii\helpers\Url;

$this->title = 'Загрузить фотографии';
?>

<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-info">
            <p>Эта страница по загрузке фотографий квартиры, точнее ее состояние и все, что звязано с покупкой в нее всего нового, либо замена</p>
            <p>Перейти в уже созданные <b><a href="<?= Url::toRoute('photo/albums')?>">альбомы</a></b></p>
        </div>
    </div>
</div>
