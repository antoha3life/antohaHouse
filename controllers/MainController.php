<?php

namespace app\controllers;

use app\base\BaseController;
use app\forms\ContactForm;
use app\models\{
    PaymentHouse,
    PaymentYear,
    User
};
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;

/**
 * Main controller.
 */
class MainController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

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
        if (Yii::$app->user->isGuest) {
            return $this->redirect('account/login');
        }

        $user_id = Yii::$app->user->getId();
        $query = PaymentHouse::find()->where(['user_id' => $user_id]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $pages->forcePageParam = false;
        $pages->pageSizeParam = false;
        $pages->setPageSize(10);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy(['id' => SORT_DESC])
            ->all();

        $data = [
            'count_all_pay' => PaymentYear::find()->where(['p_user' => BaseController::getUserParam('uuid_pay')])->one(),
            'models' => $models,
            'pages' => $pages
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

    public function actionAddprice()
    {
        $model = new PaymentHouse();
        $model->user_id = Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->save()) {

                    $uuid_user = BaseController::getUserParam('uuid_pay');
                    $pay = PaymentYear::find()->where(['p_user' => $uuid_user, 'p_year' => date('Y')])->one();
                    if ($pay) {
                        $pay->price_count = $pay->price_count + $model->price_pay;
                        $pay->save();
                    } else {
                        $payment_year = new PaymentYear();
                        $payment_year->p_uuid = $model->uuid;
                        $payment_year->p_user = $uuid_user;
                        $payment_year->p_year = date('Y');
                        $payment_year->price_count = $payment_year->price_count + $model->price_pay;
                        $payment_year->save();

                        //$uuid_user->uuid_pay = $model->uuid;
                        //$uuid_user->save();
                    }
                    Yii::$app->session->addFlash('success', 'Успешно добавлена оплата');
                    //$this->redirect(['addprice', 'id' => 'success']);
                }
            }
        }

        return $this->render('add_price', [
            'model' => $model,
        ]);
    }
}
