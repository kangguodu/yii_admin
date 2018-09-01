<?php

namespace app\controllers;
use Yii;
//use app\models\ServiceAutoReply;
class TreesController extends \yii\web\Controller
{

    public function actionIndex()
    {
    	$isAdmin =  false;
    	if(isset(Yii::$app->user->identity->username)){
    		if(Yii::$app->user->identity->username == 'memeadmin'){
    			$isAdmin = true;
    		}
    	}
    	
        return $this->render('index',[
        	'isAdmin' => $isAdmin
        ]);
    }

    // public function actionRoot(){
    //     $countries = new ServiceAutoReply(['name' => '會員客服自動回覆','lvl' => 1,'lft' => 1,'rgt' =>2]);
    //     $countries->makeRoot();
    //     var_dump($countries->getErrors());
    // }

}
