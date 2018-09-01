<?php

namespace app\controllers;

use Yii;
use app\models\Goods;
use app\models\search\GoodsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * GoodsController implements the CRUD actions for Goods model.
 */
class GoodsController extends Controller
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
     * Lists all Goods models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GoodsSearch();
        $session = Yii::$app->session;
        $query = Yii::$app->request->queryParams;
        if($session->get('goodsindex_query') && !isset($query['GoodsSearch'])){
            $query = $session->get('goodsindex_query');
        }else{
            $session->set('goodsindex_query',$query);
        }
        $goodsCount = 0;
        if(isset($query['GoodsSearch']['store_id']) && intval($query['GoodsSearch']['store_id']) > 0){
            $goodsCount = Goods::find()->where(['store_id' => $query['GoodsSearch']['store_id']])->count();
        }
        $dataProvider = $searchModel->search($query);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'storeGoodsCount' => $goodsCount
        ]);
    }

    /**
     * Displays a single Goods model.
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
     * Creates a new Goods model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Goods();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $image = UploadedFile::getInstance($model, 'image');
            $save_path=\Yii::getAlias('@uploads'); 
            $save_url='/upload/goods/';
            if(!file_exists($save_path)){
                mkdir($save_path);
            }

            if ($image) {
                //新文件名
                $new_file_name= Yii::$app->security->generateRandomString().'.'.$image->getExtension();
                $image->saveAs($save_path.'/goods/'.$new_file_name);
                $model->image = $save_url.$new_file_name;
            }

            if(empty($model->image)){
                unset($model->image);
            }
            $model->created_at = time();
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
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Goods model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())  && $model->validate()) {

            $image = UploadedFile::getInstance($model, 'image');
            $save_path=\Yii::getAlias('@uploads'); 
            $save_url='/upload/goods/';
            if(!file_exists($save_path)){
                mkdir($save_path);
            }

            if ($image) {
                //新文件名
                $new_file_name= Yii::$app->security->generateRandomString().'.'.$image->getExtension();
                $image->saveAs($save_path.'/goods/'.$new_file_name);
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
     * Deletes an existing Goods model.
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
     * Finds the Goods model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Goods the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Goods::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    protected function findJoinModel($id){
        $query = Goods::find();
        $query->select('`goods`.*,`store`.`name` as `store_name`');
        $query->leftJoin('store','`goods`.`store_id` = `store`.`id`');
        $query->where(['`goods`.id' => $id]);
        $result = $query->one();
        if($result !== null){
            return $result;
        }
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.')); 
    }
}
