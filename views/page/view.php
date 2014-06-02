<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use kartik\widgets\SideNav;

/**
 * @var yii\base\View $this
 * @var frenzelgmbh\scms\models\Page $model
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = array('label' => 'Pages', 'url' => array('index'));
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

	<h1><?= Html::encode($this->title); ?></h1>

	<div>
		<?= Html::a('Update', array('update', 'id' => $model->id), array('class' => 'btn btn-danger')); ?>
		<?= Html::a('Delete', array('delete', 'id' => $model->id), array('class' => 'btn btn-danger')); ?>
	</div>

	<?= DetailView::widget(array(
		'model' => $model,
		'attributes' => array(
			'id',
			'name:ntext',
			'body:ntext',
			'parent_pages_id',
			'ord',
			'created_at:datetime',
			'special',
			'title:ntext',
			'template:ntext',
			'category',
			'tags:ntext',
			'description:ntext',
			'date_associated',
			'vars:ntext',
			'status',
		),
	)); ?>

</div>
