<?php

use yii\helpers\Html;
use kartik\widgets\SideNav;

/**
 * @var yii\base\View $this
 * @var frenzelgmbh\scms\models\Page $model
 */

$this->title = 'Create Page';
$this->params['breadcrumbs'][] = array('label' => 'Pages', 'url' => array('index'));
$this->params['breadcrumbs'][] = $this->title;
?>

<?php yii\widgets\Block::begin(array('id'=>'sidebar')); ?>

  <?php 

    $sideMenu = array();
    $sideMenu[] = array('icon'=>'arrow-left','label'=>Yii::t('app','Overview'),'url'=>Url::to(array('/pages/page/index')));
    //$sideMenu[] = array('icon'=>'plus','label'=>Yii::t('app','New Page'),'url'=>Url::to(array('/pages/page/create')));
    //$sideMenu[] = array('icon'=>'arrow-right','label'=>Yii::t('app','Manage Categories'),'url'=>Url::to(array('/categories/categories/index')));
    //$sideMenu[] = array('icon'=>'arrow-right','label'=>Yii::t('app','Manage Tags'),'url'=>Url::to(array('/tags/default/index')));
   
    echo SideNav::widget([
      'type' => SideNav::TYPE_INFO,
      'heading' => 'CMS Menu',
      'items' => $sideMenu
    ]);

  ?>

<?php yii\widgets\Block::end(); ?>

<div class="module-wsp">

	<h1><?= Html::encode($this->title); ?></h1>

	<?= $this->render('_form', array(
		'model' => $model,
	)); ?>

</div>
