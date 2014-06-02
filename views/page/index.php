<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\widgets\SideNav;
use yii\grid\DataColumn;

/**
 * @var yii\base\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var frenzelgmbh\scms\models\PageForm $searchModel
 */

$this->title = 'Manage Content Pages';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php yii\widgets\Block::begin(array('id'=>'sidebar')); ?>

	<?php 

  	$sideMenu = array();
  	$sideMenu[] = array('icon'=>'book','label'=>Yii::t('app','CMS'),'url'=>Url::to(array('/pages/page/index')));
    $sideMenu[] = array('icon'=>'plus','label'=>Yii::t('app','New Page'),'url'=>Url::to(array('/pages/page/create')));
    //$sideMenu[] = array('icon'=>'arrow-right','label'=>Yii::t('app','Manage Categories'),'url'=>Url::to(array('/categories/categories/index')));
    //$sideMenu[] = array('icon'=>'arrow-right','label'=>Yii::t('app','Manage Tags'),'url'=>Url::to(array('/tags/default/index')));
   
    echo SideNav::widget([
      'type' => SideNav::TYPE_INFO,
      'heading' => 'CMS Menu',
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
			['class' => 'yii\grid\SerialColumn'],
      //'id',
			'name:ntext',
			//'body:html',
			//'parent_pages_id',
			'ord',
			// 'time_create:datetime',
			//'time_update:datetime',
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
