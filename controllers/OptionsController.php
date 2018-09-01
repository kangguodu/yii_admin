<?php

namespace app\controllers;

use app\models\Options;
use app\models\OptionsForm;
use Yii;

class OptionsController extends BaseController
{
    public function actionIndex()
    {
        $model = new OptionsForm();

        if (Yii::$app->getRequest()->getIsPost()) {
            if ($model->load(Yii::$app->getRequest()->post()) && $model->validate() && $model->setOptionsConfig()) {
                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Success'));
            } else {
                $errors = $model->getErrors();
                $err = '';
                foreach ($errors as $v) {
                    $err .= $v[0] . '<br>';
                }
                Yii::$app->getSession()->setFlash('error', $err);
            }
        }

        $model->getOptionsSetting();
        return $this->render('index', [
            'model' => $model,
        ]);
    }



}
