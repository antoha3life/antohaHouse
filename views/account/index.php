<?php

/**
 * @var $this yii\web\View
 */

$this->title = Yii::t(ROUTE, 'Account') . ' ' .
    ucfirst(Yii::$app->user->identity->username);

?>

<div class="row">
    <div class="col-lg-12">
        <h1><?= $this->title ?></h1>
    </div>
    <div class="col-lg-6">

    </div>
</div>
