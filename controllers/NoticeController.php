<?php

namespace app\controllers;

use app\models\Activity;
use Yii;
use app\models\Notice;
use app\models\search\NoticeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\services\Notification;


/**
 * NoticeController implements the CRUD actions for Notice model.
 */
class NoticeController extends Controller
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
     * Lists all Notice models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NoticeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Notice model.
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
     * Creates a new Notice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Notice();
        $model->updated_at = date('Y-m-d H:i:s');
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $image = UploadedFile::getInstance($model, 'icon');
            $save_path=\Yii::getAlias('@uploads');
            $save_url='/upload/notice/';
            if(!file_exists($save_path)){
                mkdir($save_path);
            }

            if ($image) {
                //新文件名
                $new_file_name= Yii::$app->security->generateRandomString().'.'.$image->getExtension();
                $image->saveAs($save_path.'/notice/'.$new_file_name);
                $model->icon = $save_url.$new_file_name;
            }

            if(empty($model->icon)){
                unset($model->icon);
            }

            $model->created_at = date('Y-m-d H:i:s');

            $model->member_id = 0;
            if($model->save()){
                $notification = new Notification();
                if($model->type_id == 1){
                    $activity = Activity::find()->select('id,type,url')
                    ->where(['id'=> $model->point_id])->one()->toArray();
                    $notification->prepare('member',[
                        'title' => $model->title,
                        'description' => $model->description,
                        'point_id' => $model->point_id
                    ],'activity',$activity)->send();
                }else if($model->type_id == 3){

                    $notification->prepare('member', [
                        'title' => $model->title,
                        'description' => $model->description
                    ], 'system', ['id' => $model->id])
                        ->send();
                }
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
            return $this->redirect(['index']);
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

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Notice model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $image = UploadedFile::getInstance($model, 'icon');
            $save_path=\Yii::getAlias('@uploads');
            $save_url='/upload/notice/';
            if(!file_exists($save_path)){
                mkdir($save_path);
            }

            if ($image) {
                //新文件名
                $new_file_name= Yii::$app->security->generateRandomString().'.'.$image->getExtension();
                $image->saveAs($save_path.'/notice/'.$new_file_name);
                $model->icon = $save_url.$new_file_name;
            }

            if(empty($model->icon)){
                unset($model->icon);
            }

            $model->updated_at = date('Y-m-d H:i:s');
            $model->member_id = 0;
            if($model->save()){
//                $notification = new Notification();
//                if($model->type_id == 1){
//                    $activity = Activity::find()->select('id,type,url')
//                        ->where(['id'=> $model->point_id])->one()->toArray();
//                    $notification->prepare('member',[
//                        'title' => $model->title,
//                        'description' => $model->description,
//                        'point_id' => $model->point_id
//                    ],'activity',$activity)->send();
//                }else if($model->type_id == 3){
//
//                    $notification->prepare('member', [
//                        'title' => $model->title,
//                        'description' => $model->description
//                    ], 'system', ['id' => $model->id])
//                        ->send();
//                }
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
            return $this->redirect(['index']);
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
     * Deletes an existing Notice model.
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
     * Finds the Notice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Notice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Notice::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
