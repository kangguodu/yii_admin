<?php
/* @var $this yii\web\View */
use kartik\tree\TreeView;
use app\models\ServiceAutoReply;


$this->title = Yii::t('app', 'Service Auto Reply');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php echo Yii::$app->params['content_common_start'];?>
<?php 
echo TreeView::widget([
    // single query fetch to render the tree
    // use the Product model you have in the previous step
    'query' => ServiceAutoReply::find()->addOrderBy('root, lft'), 
    'headingOptions' => ['label' => '客服自動回覆'],
    'fontAwesome' => true,     // optional
    'displayValue' => 1,        // initial display value
    'softDelete' => false,       // defaults to true
    'isAdmin' => $isAdmin,
    'cacheSettings' => [        
        'enableCache' => true   // defaults to true
    ],
    'iconEditSettings'  => [
        'show' => 'none',
        'type' => TreeView::ICON_CSS,
        'listData' => []
    ],
    'mainTemplate' => '<div class="row">
	    <div class="col-sm-7">
	        {wrapper}
	    </div>
	    <div class="col-sm-5">
	        {detail}
	    </div>
	</div>',
	'allowNewRoots' => false,
]);

?>

<?php echo Yii::$app->params['content_common_end'];?>