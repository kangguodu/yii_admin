<?php

namespace app\controllers;

use Yii;
use app\models\StoreUser;
use app\models\search\StoreUserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use  yii\web\Session;
/**
 * StoreUserController implements the CRUD actions for StoreUser model.
 */
class StoreUserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all StoreUser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StoreUserSearch();
        $session = Yii::$app->session;
        $query = Yii::$app->request->queryParams;
        if($session->get('storeuser_query') && !isset($query['StoreUserSearch'])){
            $query = $session->get('storeuser_query');
        }else{
            $session->set('storeuser_query',$query);
        }
        $dataProvider = $searchModel->search($query);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StoreUser model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new StoreUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StoreUser();
        $model->setScenario('add_user');
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->zone = '886';
            $model->email = '';
            $model->permission = 'ONLYSEE';
            $model->gender = '';
            $model->created_at = date('y-m-d H:m:s');
            $model->updated_at = date('y-m-d H:m:s');
            if(!empty($model->password)){
                $model->password = \Yii::$app->security->generatePasswordHash($model->password);
            }
            if(empty($model->password)){
               unset($model->password);
            }

            $postData = Yii::$app->request->post();
            if($postData['StoreUser']['menus']){
                $postData['StoreUser']['menus'][] = '1';
                $postData['StoreUser']['menus'][] = '6';
           }else{
                $postData['StoreUser']['menus'] = ['1','6'];
           }
            $model->getMenusData($postData['StoreUser']['menus']);
            if($model->save()){
                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'save_succeeded'));
                return $this->redirect(['index']);
            }else {
                $errors = $model->getErrors();
                $err = '';
                foreach ($errors as $v) {
                    $err .= $v[0] . '<br>';
                }
                Yii::$app->getSession()->setFlash('error', $err);
            }
        }else {
            $errors = $model->getErrors();
            $err = '';
            foreach ($errors as $v) {
                $err .= $v[0] . '<br>';
            }
            if(!empty($err)){
                Yii::$app->getSession()->setFlash('error', $err);
            }
            
        }
        $getData = Yii::$app->request->get();
        if(isset($getData['store_id'])){
            $model->store_id = $getData['store_id'];
        }
        $model->position = '正職員工';
        $model->super_account = 0;
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing StoreUser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

       // var_dump(Yii::$app->request->post());
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
           $postData = Yii::$app->request->post();
           if($postData['StoreUser']['menus']){
                $postData['StoreUser']['menus'][] = '1';
                $postData['StoreUser']['menus'][] = '6';
           }else{
                $postData['StoreUser']['menus'] = ['1','6'];
           }
           $model->getMenusData($postData['StoreUser']['menus']);
           $model->updated_at = date('y-m-d H:m:s');
           if(!empty($model->password)){
                $model->password = \Yii::$app->security->generatePasswordHash($model->password);
           }
           if(empty($model->password)){
               unset($model->password);
           }

           if($model->save()){
                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'update_succeeded'));
                return $this->redirect(['index']);
            }else {
                $errors = $model->getErrors();
                $err = '';
                foreach ($errors as $v) {
                    $err .= $v[0] . '<br>';
                }
                if(!empty($err)){
                    Yii::$app->getSession()->setFlash('error', $err);
                }
                
            }
        }else {
                $errors = $model->getErrors();
                $err = '';
                foreach ($errors as $v) {
                    $err .= $v[0] . '<br>';
                }
                if(!empty($err)){
                    Yii::$app->getSession()->setFlash('error', $err);
                }
                
            }
        $model = $model->beforeUpdateForm($model);
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing StoreUser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the StoreUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StoreUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StoreUser::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
