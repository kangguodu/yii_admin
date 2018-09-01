<?php

namespace app\controllers;

use app\models\Store;
use app\models\StoreAccount;
use app\models\StoreTrans;
use app\models\StoreUser;
use Yii;
use app\models\Withdraw;
use app\models\search\WithdrawSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\MemberCredits;
use app\models\MemberCreditsLog;
use  yii\web\Session;

/**
 * WithdrawController implements the CRUD actions for Withdraw model.
 */
class WithdrawController extends Controller
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
     * Lists all Withdraw models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WithdrawSearch();
        $session = Yii::$app->session;
        $query = Yii::$app->request->queryParams;
        if($session->get('withdraw_query') && !isset($query['WithdrawSearch'])){
            $query = $session->get('withdraw_query');
        }else{
            $session->set('withdraw_query',$query);
        }
        $dataProvider = $searchModel->search($query);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Withdraw model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $query = Withdraw::find();
        $query->select('`withdrawl`.*,store.name as `store_name`,`member`.`nickname`');
        $query->leftJoin('store','`store`.`id` = `withdrawl`.`store_id`');
        $query->leftJoin('member','`member`.`id` = `withdrawl`.`uid`');
        $query->where(['`withdrawl`.id' => $id]);
        $result = $query->one();
        return $this->render('view', [
            'model' => $result,
        ]);
    }

    /**
     * Creates a new Withdraw model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Withdraw();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Withdraw model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldStatus = intval($model->status);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if($oldStatus <= 0 && $model->status == 2 && $model->type == 2){
                $credits = MemberCredits::findOne(['member_id' => $model->uid]);
                if ($model->amount <= $credits->freeze_credits){
                    $credits->freeze_credits -= $model->amount;
                    $credits->promo_credits += $model->amount;
                    $credits->save();
                }
            }

            if($oldStatus <= 0 && $model->status == 1 ){
                $result = false;
                if($model->type == 1){
                    $result = $this->storeTrans($model);
                }else if($model->type == 2){
                    $result = $this->memberTrans($model);
                }

                if($result !== true){
                    $model->status = $oldStatus;
                    Yii::$app->getSession()->setFlash('error', $result);
                }
            }


            if($oldStatus > 0){
                $model->status = $oldStatus;
            }

            if($model->save()){
                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'update_succeeded'));
            }else{
                Yii::$app->getSession()->setFlash('error', Yii::t('app', 'update_failed'));
            }
            return $this->redirect(['index']);

        }
        if(empty($model->handle_date) || $model->handle_date = '0000-00-00 00:00:00' ){
            $model->handle_date = date('Y-m-d H:i:s');
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Withdraw model.
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
     * Finds the Withdraw model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Withdraw the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Withdraw::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionCancel($id){
        $model = $this->findModel($id);
        $oldStatus = intval($model->status);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if($oldStatus <= 0 && $model->status == 2 ){
                if($model->type == 2){
                   $credits = MemberCredits::findOne(['member_id' => $model->uid]);
                    if ($model->amount <= $credits->freeze_credits){
                        $credits->freeze_credits -= $model->amount;
                        $credits->promo_credits += $model->amount;
                        $credits->save();
                    } 
                }else if($model->type == 1){
                    $storeAccount2 = StoreAccount::findOne(['store_id' => $model->store_id]);
                    if($model->money_type == 1){
                        //蜂幣收入
                        Yii::$app->db->createCommand()->update('store_account', [
                            'business_income' => $storeAccount2->business_income + $model->amount
                        ], 'id = '.$storeAccount2->id)->execute();
                    }else if($model->money_type == 2){
                        //營業收入
                        Yii::$app->db->createCommand()->update('store_account', [
                            'credits_income' => $storeAccount2->credits_income + $model->amount
                        ], 'id = '.$storeAccount2->id)->execute();
                    }
                }
                
            }

            if($oldStatus <= 0 && $model->status == 1 ){
                $result = false;
                if($model->type == 1){
                    $result = $this->storeTrans($model);
                }else if($model->type == 2){
                    $result = $this->memberTrans($model);
                }

                if($result !== true){
                    $model->status = $oldStatus;
                    Yii::$app->getSession()->setFlash('error', $result);
                }
            }

            if($oldStatus > 0){
                $model->status = $oldStatus;
            }


            if($model->save()){
                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'update_succeeded'));
            }else{
                Yii::$app->getSession()->setFlash('error', Yii::t('app', 'update_failed'));
            }
            return $this->redirect(['index']);

        }
        if(empty($model->handle_date) || $model->handle_date = '0000-00-00 00:00:00' ){
            $model->handle_date = date('Y-m-d H:i:s');
        }
        $model->status = 2;
        return $this->render('update', [
            'model' => $model,
        ]);
    }


    public function actionComplete($id){
        $model = $this->findModel($id);
        $result = false;
        if($model->type == 1){
            $result = $this->storeTrans($model);
        }else if($model->type == 2){
            $result = $this->memberTrans($model);
        }

        if($result === true){
            $model->status = 1;
            $model->handle_date = date('Y-m-d H:i:s');
            $model->save();
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'complete_succeeded'));
            return $this->redirect(['index']);
        }else{
            Yii::$app->getSession()->setFlash('error', $result);
            return $this->redirect(['index']);
        }

    }

    private function memberTrans($withdraw)
    {
        $credit = MemberCredits::findOne(['member_id' => $withdraw->uid]);
        if($credit){
            if ($credit->freeze_credits < $withdraw->amount)
                return '提现金额大于会员冻结金额，处理失败!';

            $log = new MemberCreditsLog();
            $log->type = 2;
            $log->trade_type = '请款支出';
            $log->date = date('Y-m-d');
            $log->log_date = date('Y-m-d H:i:s');
            $log->amount = $withdraw->amount;
            $log->balance = $credit->freeze_credits + $credit->promo_credits;
            $log->status = 1;
            $log->order_id = 0;
            $log->order_sn = '';
            $log->log_no = '201'.date('ymdHis').mt_rand(10,99);
            $log->remark = '请款支出';
            $log->member_id = $withdraw->uid;
            $log->save();

            $credit->freeze_credits -= $withdraw->amount;
            $credit->save();
        }

        return true;
    }
    private function storeTrans($withdraw)
    {
        $storeAccount = StoreAccount::findOne(['store_id' => $withdraw->store_id]);

        if (!$storeAccount){
            return '店家账户不存在，处理失败!';
        }

        // if ($storeAccount->credits_income < $withdraw->amount){
        //     return '提现金额大于店家营业收入，处理失败!';
        // }

        $store = Store::findOne($withdraw->store_id);
        $storeUser = StoreUser::findOne($store->super_uid);

        $storeTrans = new StoreTrans();
        $storeTrans->store_id = $withdraw->store_id;
        $storeTrans->trans_type = 2;
        $storeTrans->trans_category = 5;
        $storeTrans->trans_category_name = '请款支出';
        
        $storeTrans->trans_date = date('Y-m-d');
        $storeTrans->trans_datetime =  date('Y-m-d H:i:s');
        $storeTrans->amount = $withdraw->amount;
        if($withdraw->money_type == 1){
            //1蜂幣
            $storeTrans->trans_description = '蜂幣收入请款支出,帳務管理費: '.$withdraw->service_charge;
            $storeTrans->balance = $storeAccount->business_income + $withdraw->amount;
        }else if($withdraw->money_type == 2){
            //2回饋
            $storeTrans->trans_description = '回饋收入请款支出,帳務管理費: '.$withdraw->service_charge;
            $storeTrans->balance = $storeAccount->credits_income + $withdraw->amount;
        }
        
        $storeTrans->created_at = date('Y-m-d H:i:s');
        $storeTrans->created_by = $storeUser->id;
        $storeTrans->created_name = $storeUser->nickname;
        $storeTrans->custom_field1 = '';
        $storeTrans->save();
//        var_dump($storeTrans->getErrors());
//        exit();

        // $storeAccount->credits_income -= $withdraw->amount;
        // $storeAccount->save();
        return true;
    }

}
