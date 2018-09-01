<?php

namespace app\controllers;

use Yii;
use app\models\StoreBankAccount;
use app\models\search\StoreBankAccountSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StoreBankAccountController implements the CRUD actions for StoreBankAccount model.
 */
class StoreBankAccountController extends Controller
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
     * Lists all StoreBankAccount models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StoreBankAccountSearch();
        $session = Yii::$app->session;
        $query = Yii::$app->request->queryParams;
        if($session->get('storebank_query') && !isset($query['StoreBankAccountSearch'])){
            $query = $session->get('storebank_query');
        }else{
            $session->set('storebank_query',$query);
        }
        $dataProvider = $searchModel->search($query);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StoreBankAccount model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findJoinModel($id),
        ]);
    }

    /**
     * Creates a new StoreBankAccount model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StoreBankAccount();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->created_at = date('Y-m-d H:i:s');
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
        }else{
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
        $model->status = 1;
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing StoreBankAccount model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if($model->save()){
                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'update_succeeded'));
                return $this->redirect(['index']);
            }else {
                $errors = $model->getErrors();
                $err = '';
                foreach ($errors as $v) {
                    $err .= $v[0] . '<br>';
                }
                Yii::$app->getSession()->setFlash('error', $err);
            }
        }else{
            $errors = $model->getErrors();
            $err = '';
            foreach ($errors as $v) {
                $err .= $v[0] . '<br>';
            }
            if(!empty($err)){
                Yii::$app->getSession()->setFlash('error', $err);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing StoreBankAccount model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->getSession()->setFlash('success', Yii::t('app', 'delete_succeeded'));
        return $this->redirect(['index']);
    }

    /**
     * Finds the StoreBankAccount model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StoreBankAccount the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StoreBankAccount::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    protected function findJoinModel($id){
        $query = StoreBankAccount::find();
        $query->select('`store_bank_account`.*,`store`.`name` as `store_name`');
        $query->leftJoin('store','`store_bank_account`.`store_id` = `store`.`id`');
        $query->where(['`store_bank_account`.id' => $id]);
        $result = $query->one();
        if($result !== null){
            return $result;
        }
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.')); 
    }
}
