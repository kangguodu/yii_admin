<?php

namespace app\controllers;

use Yii;
use app\models\Activity;
use app\models\search\ActivitySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ActivityController implements the CRUD actions for Activity model.
 */
class ActivityController extends Controller
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
     * Lists all Activity models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ActivitySearch();
        $session = Yii::$app->session;
        $query = Yii::$app->request->queryParams;
        if($session->get('activity_query') && !isset($query['ActivitySearch'])){
            $query = $session->get('activity_query');
        }else{
            $session->set('activity_query',$query);
        }
        $dataProvider = $searchModel->search($query);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Activity model.
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
     * Creates a new Activity model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Activity();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $image = UploadedFile::getInstance($model, 'posters_pictures');
            $save_path=\Yii::getAlias('@uploads'); 
            $save_url='/upload/activity/';
            if(!file_exists($save_path)){
                mkdir($save_path);
            }

            if ($image) {
                //新文件名
                $new_file_name= Yii::$app->security->generateRandomString().'.'.$image->getExtension();
                $image->saveAs($save_path.'/activity/'.$new_file_name);
                $model->posters_pictures = $save_url.$new_file_name;
            }

            if(empty($model->posters_pictures)){
                unset($model->posters_pictures);
            }

            $model->created_at = date('Y-m-d H:i:s');
            $model->created_by = Yii::$app->user->identity->username;
            
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
            return $this->redirect(['index']);
        }
        $model->discount = 0;
        $model->show_time = date('Y-m-d H:i:s');
        $model->start_at = date('Y-m-d H:i:s');
        $model->checked = 1;
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Activity model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $image = UploadedFile::getInstance($model, 'posters_pictures');
            $save_path=\Yii::getAlias('@uploads'); 
            $save_url='/upload/activity/';
            if(!file_exists($save_path)){
                mkdir($save_path);
            }

            if ($image) {
                //新文件名
                $new_file_name= Yii::$app->security->generateRandomString().'.'.$image->getExtension();
                $image->saveAs($save_path.'/activity/'.$new_file_name);
                $model->posters_pictures = $save_url.$new_file_name;
            }

            if(empty($model->posters_pictures)){
                unset($model->posters_pictures);
            }

            $model->created_at = date('Y-m-d H:i:s');
            $model->created_by = Yii::$app->user->identity->username;
            
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
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Activity model.
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
     * Finds the Activity model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Activity the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Activity::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionCopy($id){
        $model = $this->findModel($id);

        $copyModel = new Activity();
        $copyModel->title = $model->title.'-複製';
        $copyModel->content = $model->content;
        $copyModel->description = $model->description;
        $copyModel->type = $model->type;
        $copyModel->created_at = date('Y-m-d H:i:s');
        $copyModel->created_by = Yii::$app->user->identity->username;
        $copyModel->start_at = $model->start_at;
        $copyModel->expire_at = $model->expire_at;
        $copyModel->checked = $model->checked;
        $copyModel->platform_type = $model->platform_type;
        $copyModel->posters_pictures = $model->posters_pictures;
        $copyModel->discount = $model->discount;
        $copyModel->url = $model->url;
        $copyModel->show_time = $model->show_time;
        $copyModel->save();
        $errors = $copyModel->getErrors();
        $err = '';
        foreach ($errors as $v) {
            $err .= $v[0] . '<br>';
        }
        if(!empty($err)){
            Yii::$app->getSession()->setFlash('error', $err);
        }else{
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'copy_succeeded'));
        }
        return $this->redirect(['index']);
    }
}
