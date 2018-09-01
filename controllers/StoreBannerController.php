<?php

namespace app\controllers;

use Yii;
use app\models\StoreBanner;
use app\models\search\StoreBannerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * StoreBannerController implements the CRUD actions for StoreBanner model.
 */
class StoreBannerController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all StoreBanner models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StoreBannerSearch();
        $session = Yii::$app->session;
        $query = Yii::$app->request->queryParams;
        if($session->get('storebanner_query') && !isset($query['StoreBannerSearch'])){
            $query = $session->get('storebanner_query');
        }else{
            $session->set('storebanner_query',$query);
        }
        $dataProvider = $searchModel->search($query);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StoreBanner model.
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
     * Creates a new StoreBanner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StoreBanner();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $image = UploadedFile::getInstance($model, 'image');
            $save_path=\Yii::getAlias('@uploads'); 
            $save_url='/upload/banner/';
            if(!file_exists($save_path)){
                mkdir($save_path);
            }

            if ($image) {
                //新文件名
                $new_file_name= Yii::$app->security->generateRandomString().'.'.$image->getExtension();
                $image->saveAs($save_path.'/banner/'.$new_file_name);
                $model->image = $save_url.$new_file_name;
            }

            if(empty($model->image)){
                unset($model->image);
            }
            
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
        $getData = Yii::$app->request->get();
        if(isset($getData['store_id'])){
            $model->store_id = $getData['store_id'];
        }
        $model->rank = 1;
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing StoreBanner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $image = UploadedFile::getInstance($model, 'image');
            $save_path=\Yii::getAlias('@uploads'); 
            $save_url='/upload/banner/';
            if(!file_exists($save_path)){
                mkdir($save_path);
            }

            if ($image) {
                //新文件名
                $new_file_name= Yii::$app->security->generateRandomString().'.'.$image->getExtension();
                $image->saveAs($save_path.'/banner/'.$new_file_name);
                $model->image = $save_url.$new_file_name;
            }

            if(empty($model->image)){
                unset($model->image);
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
                Yii::$app->getSession()->setFlash('error', $err);
            }
            return $this->redirect(['index']);
        }else {
            $errors = $model->getErrors();
            if(count($errors)){
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
     * Deletes an existing StoreBanner model.
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
     * Finds the StoreBanner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StoreBanner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StoreBanner::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    protected function findJoinModel($id){
        $query = StoreBanner::find();
        $query->select('`store_banner`.*,`store`.`name` as `store_name`');
        $query->leftJoin('store','`store_banner`.`store_id` = `store`.`id`');
        $query->where(['`store_banner`.id' => $id]);
        $result = $query->one();
        if($result !== null){
            return $result;
        }
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.')); 
    }
}
