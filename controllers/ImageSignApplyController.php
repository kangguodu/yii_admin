<?php

namespace app\controllers;

use Yii;
use app\models\ImageSignApply;
use app\models\search\ImageSignApplySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\ImageSignApplyDetail;
use app\models\ImageSign;
use yii\data\ArrayDataProvider;

/**
 * ImageSignApplyController implements the CRUD actions for ImageSignApply model.
 */
class ImageSignApplyController extends Controller
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
     * Lists all ImageSignApply models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ImageSignApplySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ImageSignApply model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $selectField = '`image_sign_apply_detail`.`quantity`,`image_sign_apply_detail`.`amount`,';
        $selectField .= '`image_sign_apply_detail`.`id`,`image_sign`.`title`,`image_sign`.`cover`,`image_sign`.`image_config`,`image_sign`.`price`';
        $selectField .= ',image_sign_apply.store_id';
        $query = ImageSignApplyDetail::find()
            ->select($selectField)
            ->leftJoin('image_sign','`image_sign`.`id` = `image_sign_apply_detail`.`image_sign_id`')
            ->leftJoin('image_sign_apply','`image_sign_apply`.`id` = `image_sign_apply_detail`.`apply_id`')
            ->where(['image_sign_apply.id' => $id])->asArray()->all();

        $dataProvider = new ArrayDataProvider([
            'key'=>'id',
            'allModels' => $query,
            'sort' => [
                'attributes' => [],
            ],
        ]);


        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new ImageSignApply model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ImageSignApply();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ImageSignApply model.
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
     * Deletes an existing ImageSignApply model.
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
     * Finds the ImageSignApply model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ImageSignApply the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ImageSignApply::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionDownload($id,$store_id){
        $save_path = \Yii::getAlias('@meme_public'); 
        if (($model = ImageSignApplyDetail::findOne($id)) !== null) {
            $imageSign2 = ImageSign::findOne($model->image_sign_id);
            $config = $imageSign2->image_config;
            $configs = json_decode($config,TRUE);
            if( $configs != null && $configs != false){
                $background =  $configs['background'];
                $background = $save_path.$background;
                if(!file_exists($background)){
                    Yii::$app->getSession()->setFlash('error', Yii::t('app', 'image sign backend not exist'));
                    return $this->redirect(['imagesign','id' => $store_id]);
                }
            }

            $fileName = $save_path.'/upload/image_sign/tv2'.md5($store_id.$model->image_sign_id).'.png';
            $imageSign = new ImageSign();
            if (!file_exists($fileName)){
                $imageSign->getDownloadAreaDetail($store_id,$model->image_sign_id);
            }
            return Yii::$app->response->sendFile($fileName);
        }else{
            Yii::$app->getSession()->setFlash('error', Yii::t('app', 'The requested page does not exist.'));
            return $this->redirect(['index']);
        }
    }

    public function actionComplete($id){
        $model = $this->findModel($id);
        ImageSignApply::updateAll(['status' => 3],['=','id',$id]);
        Yii::$app->getSession()->setFlash('success', Yii::t('app', 'update_succeeded'));
        return $this->redirect(['index']);
    }
}
