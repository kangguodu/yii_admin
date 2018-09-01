<?php

namespace app\controllers;

use Yii;
use app\models\NoticeLog;
use app\models\search\NoticeLogSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\services\Notification;
use app\models\Activity;

/**
 * NoticeLogController implements the CRUD actions for NoticeLog model.
 */
class NoticeLogController extends Controller
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
     * Lists all NoticeLog models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NoticeLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single NoticeLog model.
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
     * Creates a new NoticeLog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new NoticeLog();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $notification = new Notification();
            if($model->type == 2){
                $activity = Activity::find()->select('id,type,url')
                    ->where(['id'=> $model->point_id])->one()->toArray();
                $notification->prepare('merchant',[
                    'title' => $model->title,
                    'description' => $model->description,
                    'point_id' => $model->point_id
                ],'activity',$activity)->send();
            }else if($model->type == 1){
                //系统通知
                $notification->prepare('merchant', [
                    'title' => $model->title,
                    'description' => $model->description
                ], 'system', ['id' => $model->id])
                    ->send();
            }
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'save_succeeded'));
            return $this->redirect(['index']);
        }
        $model->type = 1;
        $model->point_id = 0;
        $model->url = 0;
        $model->created_at = date('Y-m-d H:i:s');
        $model->updated_at = date('Y-m-d H:i:s');
        $model->platform_type = 2;
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing NoticeLog model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'update_succeeded'));
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing NoticeLog model.
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
     * Finds the NoticeLog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return NoticeLog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = NoticeLog::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
