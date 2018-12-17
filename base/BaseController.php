<?php

namespace app\base;

use app\models\User;
use yii\web\Controller;

abstract class BaseController extends Controller
{
    public static function getUserParam(string $param){

        $user = User::find()->where(['id' => \Yii::$app->user->id])->one();
        return $user[$param];
    }
}
