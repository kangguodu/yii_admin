<?php

namespace app\controllers;

use Yii;
use app\components\ItemController;
use app\models\ImageSign;
use app\models\search\ImageSignSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ImageSignController implements the CRUD actions for ImageSign model.
 */
class ImageSignController extends Controller
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
     * Lists all ImageSign models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ImageSignSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ImageSign model.
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
     * Creates a new ImageSign model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ImageSign();

        if ($model->load(Yii::$app->request->post())  && $model->validate()) {
            $image = UploadedFile::getInstance($model, 'background');
            $coverImage = UploadedFile::getInstance($model, 'cover');
            
            //存储到本地的路径
            $save_path=\Yii::getAlias('@uploads'); 
            // exit($save_path);
            //存储到数据库的地址
            $save_url='/upload/download/';
            if(!file_exists($save_path)){
                mkdir($save_path);
            }

            if ($image) {
                //新文件名
                $new_file_name= Yii::$app->security->generateRandomString().'.'.$image->getExtension();
                $image->saveAs($save_path.'/download/'.$new_file_name);
                $model->setImageConfigAttribute($save_url.$new_file_name);
            }

            if ($coverImage) {
                //新文件名
                $cover_name = Yii::$app->security->generateRandomString().'.'.$coverImage->getExtension();
                $coverImage->saveAs($save_path.'/download/'.$cover_name);
                $model->cover = $save_url.$cover_name ;
            }

            if(empty($model->image_config)){
                unset($model->image_config);
            }

            if(empty($model->cover)){
                unset($model->cover);
            }
            // if(isset($model->background)){
            //     unset($model->background);
            // }
            
            $model->created_at = date('Y-m-d H:i:s');
            
            if($model->save()){
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

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionRemoveImage($id){
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        Yii::$app->response->data = [
            'status' => true
        ];
    }

    /**
     * Updates an existing ImageSign model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $image = UploadedFile::getInstance($model, 'background');
            $coverImage = UploadedFile::getInstance($model, 'cover');
            
            //存储到本地的路径
            $save_path=\Yii::getAlias('@uploads'); 
            // exit($save_path);
            //存储到数据库的地址
            $save_url='/upload/download/';
            if(!file_exists($save_path)){
                mkdir($save_path);
            }

            if ($image) {
                //新文件名
                $new_file_name= Yii::$app->security->generateRandomString().'.'.$image->getExtension();
                $image->saveAs($save_path.'/download/'.$new_file_name);
                $model->setImageConfigAttribute($save_url.$new_file_name);
            }

            if ($coverImage) {
                //新文件名
                $cover_name = Yii::$app->security->generateRandomString().'.'.$coverImage->getExtension();
                $coverImage->saveAs($save_path.'/download/'.$cover_name);
                $model->cover = $save_url.$cover_name ;
            }

            if(empty($model->image_config)){
                unset($model->image_config);
            }

            if(empty($model->cover)){
                unset($model->cover);
            }

            if($model->save()){
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
        if(!empty($model->image_config)){
            $imageConfig = json_decode($model->image_config,true);
            if($imageConfig != null && $imageConfig !== false){
                $model->background = $imageConfig['background'];
            }
            
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ImageSign model.
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
     * Finds the ImageSign model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ImageSign the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ImageSign::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
