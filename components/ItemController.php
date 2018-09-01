<?php
/**
 * Created by PhpStorm.
 * CURD Base Controller
 * @author: Techrare's php department<sales@techrare.com>
 * @date: 2016/4/28 12:05
 * @version:
 */

namespace app\components;


use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class ItemController extends Controller{

     /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $view = \Yii::$app->view;
        $view->params['sidebar_class'] = isset($_COOKIE['ibeauty_sidebar'])?$_COOKIE['ibeauty_sidebar']:'';
    }
}
