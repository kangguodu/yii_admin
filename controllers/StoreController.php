<?php

namespace app\controllers;

use Yii;
use app\models\Store;
use app\models\OpenHourRange;
use app\models\ImageSign;
use app\models\StoreTrans;
use app\models\StoreAccount;
use app\models\search\StoreSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;
use yii\data\ArrayDataProvider;
use yii\db\Query;
/**
 * StoreController implements the CRUD actions for Store model.
 */
class StoreController extends Controller
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
     * Lists all Store models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StoreSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Store model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $query = StoreTrans::find()->where(['trans_type' => 1,'trans_category' => 1])->limit(10)->orderBy('id DESC')->asArray()->all();
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
     * Creates a new Store model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Store();
        $model->setScenario('add_store');
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $postData = Yii::$app->request->post();

            $image = UploadedFile::getInstance($model, 'image');
            $save_path=\Yii::getAlias('@uploads'); 
            $save_url='/upload/store/';
            if(!file_exists($save_path)){
                mkdir($save_path);
            }

            if ($image) {
                //新文件名
                $new_file_name= Yii::$app->security->generateRandomString().'.'.$image->getExtension();
                $image->saveAs($save_path.'/store/'.$new_file_name);
                $model->image = $save_url.$new_file_name;
            }

            if(empty($model->image)){
                unset($model->image);
            }
            $superUsername = isset($postData['Store']['super_username'])?$postData['Store']['super_username']:'';
            $model->storeBeforeSaveData();
            $model->created_at = date('Y-m-d H:i:s');
            //unset($model->super_username);
            if($model->save()){
                $model->initStoreOtherInfomation([
                    'store_id' => $model->id,
                    'username' => $superUsername,
                    'phone' => $model->phone,
                ]);
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

            $postData = Yii::$app->request->post();
            if(isset($postData['Store'])){
                $model->super_username = $postData['Store']['super_username'];
            }

        }
        $model->is_return = 1;
        $model->service_status = 1;
        $model->avg_cost_status = 0;
        $model->status = 1;
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Store model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->setScenario('update_store');
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())  && $model->validate()) {
            $postData = Yii::$app->request->post();

            $image = UploadedFile::getInstance($model, 'image');
            $save_path=\Yii::getAlias('@uploads'); 
            $save_url='/upload/store/';
            if(!file_exists($save_path)){
                mkdir($save_path);
            }

            if ($image) {
                //新文件名
                $new_file_name= Yii::$app->security->generateRandomString().'.'.$image->getExtension();
                $image->saveAs($save_path.'/store/'.$new_file_name);
                $model->image = $save_url.$new_file_name;
            }

            if(empty($model->image)){
                unset($model->image);
            }
            $superUsername = isset($postData['Store']['super_username'])?$postData['Store']['super_username']:'';
            unset($model->super_username);
            $model->storeBeforeSaveData();
            if($model->save()){
                $model->updateSuperUserNickname($model->id,$superUsername);
                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'update_succeeded'));
                return $this->redirect(['index']);
            }else {
                $errors = $model->getErrors();
                $err = '';
                foreach ($errors as $v) {
                    $err .= $v[0] . '<br>';
                }
                Yii::$app->getSession()->setFlash('error', $err);
                // $model->super_username = $superUsername;
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

            $postData = Yii::$app->request->post();
            if(isset($postData['Store']['super_username'])){
                $model->super_username = $postData['Store']['super_username'];
            }

        }
        $model->beforeUpdateForm($model);
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Store model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        (new Query)->createCommand()->delete('store_user', ['store_id' => $id])->execute();
        (new Query)->createCommand()->delete('store_trans', ['store_id' => $id])->execute();
        (new Query)->createCommand()->delete('store_banner', ['store_id' => $id])->execute();
        (new Query)->createCommand()->delete('store_data', ['store_id' => $id])->execute();
        (new Query)->createCommand()->delete('store_bank_account', ['store_id' => $id])->execute();
        (new Query)->createCommand()->delete('store_account', ['store_id' => $id])->execute();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Store model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Store the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Store::findOne($id)) !== null) {
            return $model;
        }
        // Yii::$app->getSession()->setFlash('error', Yii::t('app', 'The requested page does not exist.'));
        // return $this->redirect(['index']);
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionRegionDirect(){
        //Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
        echo Html::tag('option','', ['value'=> '']) ;
        if(\Yii::$app->request->isPost){
            $request = \Yii::$app->request;
            $parent_id = $request->get('parent_id',0);
            $model = new Store();
            $result = $model->getDistrictOption($parent_id);
            foreach($result as $value=>$name)
            {
                echo Html::tag('option',Html::encode($name),array('value'=>$value));
            }
        }
    }

    public function actionImagesign($id){
        $query = ImageSign::find()->orderBy('id','DESC')->asArray()->all();
        $dataProvider = new ArrayDataProvider([
            'key'=>'id',
            'allModels' => $query,
            'sort' => [
                'attributes' => [],
            ],
        ]);


        return $this->render('imagesign', [
            'store_id' => $id,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDownload($id,$store_id){
        $save_path = \Yii::getAlias('@meme_public'); 
        if (($model = ImageSign::findOne($id)) !== null) {
            $config = $model->image_config;
            $configs = json_decode($config,TRUE);
            if( $configs != null && $configs != false){
                $background =  $configs['background'];
                $background = $save_path.$background;
                if(!file_exists($background)){
                    Yii::$app->getSession()->setFlash('error', Yii::t('app', 'image sign backend not exist'));
                    return $this->redirect(['imagesign','id' => $store_id]);
                }
            }

            $fileName = $save_path.'/upload/image_sign/tv2'.md5($store_id.$model->id).'.png';
            $imageSign = new ImageSign();
            if (!file_exists($fileName)){
                $imageSign->getDownloadAreaDetail($store_id,$model->id);
            }
            
            return Yii::$app->response->sendFile($fileName);
        }else{
            Yii::$app->getSession()->setFlash('error', Yii::t('app', 'The requested page does not exist.'));
            return $this->redirect(['index']);
        }
    }

    public function actionServicestime()
    {

         $model = new \app\models\OpenHourRange();
        if (Yii::$app->request->isPost) {
            $postData = Yii::$app->request->post();
            $model->updateStoreOpenHours($postData);
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'update_succeeded'));
            return $this->redirect(['servicestime','id' => $postData['id']]);
        }
       
        $id = 0;
        $result = array();
        if(Yii::$app->request->isGet){
            $getData = Yii::$app->request->get();
            if(isset($getData['id']) && intval($getData['id']) > 0){
                $id = $getData['id'];
            }
        }
        
        $store = $this->findModel($id);
        $result = $model->getStoreOpenHours($getData['id']);
        //var_dump($result['open_hours'][0]['time']);
        return $this->render('servicestime', [
            'model' => $model,
            'id' => $id,
            'open_hours' => $result
        ]);
    }


    protected function findJoinModel($id){
        $query = Store::find();
        $query->select('`store`.*,store_account.credits_income,store_account.return_credits,store_account.business_income');
        $query->leftJoin('store_account','`store_account`.`store_id` = `store`.`id`');
        $query->where(['`store`.id' => $id]);
        $result = $query->one();
        if($result !== null){
            return $result;
        }
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.')); 
    }

    public function actionCharge($id){
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->request->isAjax && Yii::$app->request->post()) {
            $postData = Yii::$app->request->post();
            $store = Store::findOne($id);

            $storeAccount = StoreAccount::findOne(['store_id' => $id]);
            $response->statusCode = 400;
           // return ['message' => '儲值的店鋪不存在，請重試'];
            if($store === null || $storeAccount === null){
                $response->statusCode = 400;
                return ['message' => '儲值的店鋪不存在，請重試'];
            }
            $amount = isset($postData['amount'])?$postData['amount']:0;
            $transaction = StoreAccount::getDb()->beginTransaction();
            try {
                $this->addChargeLog($storeAccount,$amount);
                $storeAccount->return_credits += $amount;
                $storeAccount->save();
                $transaction->commit();
            }catch(\Exception $e) {
                $transaction->rollBack();
                $response->statusCode = 400;
                return ['message' => '儲值失敗，請重試'];
            } catch(\Throwable $e) {
                $transaction->rollBack();
                $response->statusCode = 400;
                return ['message' => '儲值失敗，請重試'];
            }
            $response->statusCode = 200;
            $afterAmount = $storeAccount->return_credits;
            return [
                'data' => number_format($afterAmount,2,'.',''),
                'meesage' => '店鋪'.$store->name.' 成功儲值 NT$ '.$amount
            ];
        }else{
            $response->statusCode = 400;
            return ['message' => '不是正確的請求，請重試'];
        }
    }

    private function addChargeLog($storeAccount,$amount)
    {
        $storeTrans = new StoreTrans();
        $storeTrans->store_id = $storeAccount->store_id;
        $storeTrans->trans_type = 1;            //收入
        $storeTrans->trans_category = 1;
        $storeTrans->trans_category_name = '蜂幣回贈儲值金';
        $storeTrans->trans_description = '蜂幣回贈儲值金預存 '.$amount;
        $storeTrans->trans_date = date('Y-m-d');
        $storeTrans->trans_datetime  = date('Y-m-d H:i:s');
        $storeTrans->created_at = date('Y-m-d H:i:s');
        $storeTrans->amount = $amount;
        $storeTrans->balance = $storeAccount->return_credits;
        $storeTrans->created_by = Yii::$app->user->identity->id;
        $storeTrans->created_name = '系統';
        $storeTrans->save();
    }

}
