<?php

namespace app\controllers;

use Yii;
use app\models\Member;
use app\models\search\MemberSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * MemberController implements the CRUD actions for Member model.
 */
class MemberController extends Controller
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

    public function actionAsyncAvatar()
    {

    }

    /**
     * Lists all Member models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MemberSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Member model.
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
     * Creates a new Member model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Member();

        if ($model->load(Yii::$app->request->post())  && $model->validate()) {

            $image = UploadedFile::getInstance($model, 'avatar');
            $save_path=\Yii::getAlias('@uploads'); 
            $save_url='/upload/avatar/';
            if(!file_exists($save_path)){
                mkdir($save_path);
            }

            if ($image) {
                //新文件名
                $new_file_name= Yii::$app->security->generateRandomString().'.'.$image->getExtension();
                $image->saveAs($save_path.'/avatar/'.$new_file_name);
                $model->avatar = $save_url.$new_file_name;
            }

            if(empty($model->avatar)){
                unset($model->avatar);
            }

            if($model->save()){
                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'save_succeeded'));
                return $this->redirect(['view', 'id'=>$model->_id]);
            } else {
                // error in saving model
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Member model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())  && $model->validate() ) {

            $image = UploadedFile::getInstance($model, 'avatar');
            $save_path=\Yii::getAlias('@uploads'); 
            $save_url='/upload/avatar/';
            if(!is_dir($save_path)){
                mkdir($save_path);
            }

            if ($image) {
                //新文件名
                $new_file_name= Yii::$app->security->generateRandomString().'.'.$image->getExtension();
                $image->saveAs($save_path.'/avatar/'.$new_file_name);
                $model->avatar = $save_url.$new_file_name;
            }

            if(empty($model->avatar)){
                unset($model->avatar);
            }

            if($model->save()){
                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'update_succeeded'));
                return $this->redirect(['index']);
            } 
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Member model.
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
     * Finds the Member model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Member the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Member::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
