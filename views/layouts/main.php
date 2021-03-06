<?php

/**
 * @var $this    yii\web\View
 * @var $content string
 * @var $user    app\models\User
 */

use app\assets\MainAsset;
use app\helpers\JsHelper;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;

MainAsset::register($this);

$this->registerJsFile(JsHelper::getPathToJsFileByRoute(ROUTE), [
    'depends' => [
        'app\assets\MainAsset',
    ],
]);

$user = Yii::$app->user->identity;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <title><?= Html::encode($this->title) ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div>
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-default navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'nav navbar-nav navbar-right'],
        'items' => [

            // About

            //['label' => Yii::t('main', 'About'), 'url' => ['main/about']],

            // Contact

            //['label' => Yii::t('main', 'Contact'), 'url' => ['main/contact']],
            Yii::$app->user->isGuest
                ?
                    ''
                :
                ['label' => 'Добавить оплату', 'url' => ['main/addprice']],
                ['label' => 'Добавить фото', 'url' => ['photo/uploadphoto']],
            // Login

            Yii::$app->user->isGuest
                ?
                    [
                        'label' => Yii::t('main', 'Login'),
                        'url' => ['account/login'],
                    ]
                :
                    [
                        'label' => ucfirst($user->username),
                        'items' => [
                            [ 'label' => ucfirst($user->username), 'url' => ['account/index'] ],
                            [ 'label' => 'Альбомы', 'url' => ['photo/albums'] ],
                            [ 'label' => 'Настройки', 'url' => ['account/setting'] ],
                            '<li class="divider"></li>',
                            '<li>' .
                            Html::beginForm(['account/logout'], 'post', [
                                'id' => 'logout-form',
                            ]) .
                            Html::submitButton(
                                Yii::t('main', 'Logout'),
                                [
                                    'id' => 'logout-button',
                                    'class' => '',
                                    'style' => 'padding: 3px 20px; background: #fff;'
                                ]
                            ) .
                            Html::endForm() .
                            '</li>'
                        ]
                    ]
            ,

            // Signup

            Yii::$app->user->isGuest
                ?
                    [
                        'label' => Yii::t('main', 'Signup'),
                        'url' => ['account/signup'],
                    ]
                :
                    '',
        ],
    ]);
    NavBar::end();
    ?>
    <div class="container">
        <?= $content ?>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
