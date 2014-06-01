<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\widgets\SideNav;
use yii\grid\DataColumn;

/**
 * @var yii\base\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\pages\models\PageForm $searchModel
 */

$this->title = 'Manage Content Pages';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php yii\widgets\Block::begin(array('id'=>'sidebar')); ?>

	<?php 

  	$sideMenu = array();
  	$sideMenu[] = array('icon'=>'home','label'=>Yii::t('app','Home'),'url'=>Url::to(array('/site/index')));
  	$sideMenu[] = array('icon'=>'plus','label'=>Yii::t('app','New Page'),'url'=>Url::to(array('/pages/page/create')));
   
    echo SideNav::widget([
      'type' => SideNav::TYPE_DEFAULT,
      'heading' => 'Options',
      'items' => $sideMenu
    ]);

  ?>

<?php yii\widgets\Block::end(); ?>


<div class="workbench">

  <h1 class="page-header"><?= Html::encode($this->title) ?></h1>

	<?= GridView::widget(array(
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => array(
			'id',
			'name:ntext',
			//'body:html',
			//'parent_pages_id',
			'ord',
			// 'time_create:datetime',
			 'time_update:datetime',
			// 'special',
			 'title:ntext',
			 'template:ntext',
			// 'category',
			// 'tags:ntext',
			// 'description:ntext',
			// 'date_associated',
			// 'vars:ntext',
			 'status',
			['class' => 'kartik\grid\ActionColumn'],			
		),
		'panel' => [
      'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> Pages</h3>',
      'type'=>'success',
      'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Create Page', ['create'], ['class' => 'btn btn-success']),
      'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
      'showFooter'=>false
  	],
	)); ?>

</div>
