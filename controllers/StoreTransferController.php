<?php

namespace app\controllers;

use Yii;
use app\models\StoreTransfer;
use app\models\search\StoreTransferSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StoreTransferController implements the CRUD actions for StoreTransfer model.
 */
class StoreTransferController extends Controller
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
     * Lists all StoreTransfer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StoreTransferSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StoreTransfer model.
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
     * Creates a new StoreTransfer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StoreTransfer();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing StoreTransfer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing StoreTransfer model.
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
     * Finds the StoreTransfer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StoreTransfer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StoreTransfer::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionPending($id){
        $model = $this->findModel($id);
        StoreTransfer::updateAll(['status' => 'pending'],['=','id',$id]);
        Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Update Success'));
        return $this->redirect(['index']);
    }

    public function actionProcess($id){
        $model = $this->findModel($id);
        StoreTransfer::updateAll(['status' => 'processing'],['=','id',$id]);
        Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Update Success'));
        return $this->redirect(['index']);
    }

    public function actionCancel($id){
        $model = $this->findModel($id);
        StoreTransfer::updateAll(['status' => 'cancelled'],['=','id',$id]);
        Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Update Success'));
        return $this->redirect(['index']);
    }

    public function actionRefunded($id){
        $model = $this->findModel($id);
        StoreTransfer::updateAll(['status' => 'refunded'],['=','id',$id]);
        Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Update Success'));
        return $this->redirect(['index']);
    }

    public function actionCompleted($id){
        $model = $this->findModel($id);
        StoreTransfer::updateAll(['status' => 'completed'],['=','id',$id]);
        Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Update Success'));
        return $this->redirect(['index']);
    }
}
