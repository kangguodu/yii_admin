<?php

namespace app\controllers;

use app\models\Member;
use app\models\Store;
use app\models\RebateOrders;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $memberCount = Yii::$app->cache->getOrSet('home_member_count',function ($cache){
            return Member::find()->count();
        }, 5);
        $newMemberCount = Yii::$app->cache->getOrSet('home_new_member_count',function ($cache){
            return Member::find()->where(['>','created_at',date('Y-m-d 00:00:00')])->count();
        }, 5);

        $storeCount = Yii::$app->cache->getOrSet('home_store_count',function ($cache){
            return Store::find()->count();
        }, 5);

        $interestEver = Yii::$app->cache->getOrSet('home_interest_ever_count',function ($cache){
            return RebateOrders::find()->where(['cycle_status' => 2])->sum('interest_ever');
        }, 5);

        $interestRemain = Yii::$app->cache->getOrSet('home_interest_remain_count',function ($cache){
            return RebateOrders::find()->where(['in','cycle_status',[1,2]])->sum('interest_remain');
        }, 5);

        return $this->render('index',[
            'member_count' => $memberCount,
            'new_member_count' => $newMemberCount,
            'store_count' => $storeCount,
            'interest_ever' => $interestEver,
            'interest_remain' => $interestRemain
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
