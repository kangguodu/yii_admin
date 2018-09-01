<?php

namespace app\controllers;

use Yii;
use app\models\Banner;
use app\models\search\BannerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * BannerController implements the CRUD actions for Banner model.
 */
class BannerController extends Controller
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
     * Lists all Banner models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BannerSearch();
        $session = Yii::$app->session;
        $query = Yii::$app->request->queryParams;
        if($session->get('banner_query') && !isset($query['BannerSearch'])){
            $query = $session->get('banner_query');
        }else{
            $session->set('banner_query',$query);
        }
        $dataProvider = $searchModel->search($query);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Banner model.
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
     * Creates a new Banner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Banner();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $image = UploadedFile::getInstance($model, 'image_url');
            $save_path=\Yii::getAlias('@uploads'); 
            $save_url='/upload/banner/';
            if(!file_exists($save_path)){
                mkdir($save_path);
            }

            if ($image) {
                //新文件名
                $new_file_name= Yii::$app->security->generateRandomString().'.'.$image->getExtension();
                $image->saveAs($save_path.'/banner/'.$new_file_name);
                $model->image_url = $save_url.$new_file_name;
            }

            if(empty($model->image_url)){
                unset($model->image_url);
            }

            $model->region_id = 0;
            
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
        $model->rank = (Banner::find()->count()) + 1;
        //App首頁只有兩個廣告位，判斷首頁滾動圖片的數量
        $home_page_count = (Banner::find()->where(['use_type' => 2])->count());
        return $this->render('create', [
            'model' => $model,
            'home_page_count' => $home_page_count,
        ]);
    }

    /**
     * Updates an existing Banner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $image = UploadedFile::getInstance($model, 'image_url');
            $save_path=\Yii::getAlias('@uploads'); 
            $save_url='/upload/banner/';
            if(!file_exists($save_path)){
                mkdir($save_path);
            }

            if ($image) {
                //新文件名
                $new_file_name= Yii::$app->security->generateRandomString().'.'.$image->getExtension();
                $image->saveAs($save_path.'/banner/'.$new_file_name);
                $model->image_url = $save_url.$new_file_name;
            }

            if(empty($model->image_url)){
                unset($model->image_url);
            }

            $model->region_id = 0;
            
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
        }
        //App首頁只有兩個廣告位，判斷首頁滾動圖片的數量
        $home_page_count = (Banner::find()->where(['use_type' => 2])->count());
        return $this->render('update', [
            'model' => $model,
            'home_page_count' => $home_page_count,
        ]);
    }

    /**
     * Deletes an existing Banner model.
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
     * Finds the Banner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Banner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Banner::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
