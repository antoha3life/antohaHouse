<?php

namespace app\controllers;

use app\base\BaseController;
use app\forms\ContactForm;
use app\models\{PaymentHouse, PaymentYear, User};
use Yii;

/**
 * Main controller.
 */
class MainController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $user_id = Yii::$app->user->getId();
        $data = [
            'all_pays' => PaymentHouse::find()->where(['user_id' => $user_id])->orderBy(['id' => SORT_DESC ])->all(),
            'count_all_pay' => PaymentYear::find()->where(['p_uuid'=>BaseController::getUserParam('uuid_pay')])->one()
        ];
        return $this->render('index', $data);
    }

    /**
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if (
            $model->load(Yii::$app->request->post()) &&
            $model->contact(Yii::$app->params['supportEmail'])
        ) {
            Yii::$app->session->setFlash('flash-contact-form-submitted');
            return $this->refresh();
        }
        return $this->render('contact', compact('model'));
    }

    public function actionAddprice(){
        $model = new PaymentHouse();
        $model->user_id = Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()){
                if ($model->save()){

                    $uuid_user = BaseController::getUserParam('uuid_pay');
                    $pay = PaymentYear::find()->where(['p_uuid' => $uuid_user, 'p_year' => date('Y')])->one();
                    if($pay){
                        $pay->price_count = $pay->price_count + $model->price_pay;
                        $pay->save();
                    }else{
                        $payment_year = new PaymentYear();
                        $payment_year->p_uuid = $model->uuid;
                        $payment_year->p_year = date('Y');
                        $payment_year->price_count = $payment_year->price_count + $model->price_pay;
                        $payment_year->save();

                        $uuid_user->uuid_pay = $model->uuid;
                        $uuid_user->save();
                    }


                    $this->redirect(['addprice', 'id' => 'success']);
                }
            }
        }

        return $this->render('add_price', [
            'model' => $model,
        ]);
    }
}
