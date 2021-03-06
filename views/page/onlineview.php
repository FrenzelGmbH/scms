<?php

use yii\helpers\Html;
use yii\widgets\Block;
use yii\helpers\HtmlPurifier;

/**
 * @var yii\base\View $this
 * @var frenzelgmbh\scms\models\Page $model
 */

$this->title = $model->name;

if(!is_null($model->parent))
	$this->params['breadcrumbs'][] = array('label' => $model->parent->title, 'url' => array('/pages/page/onlineview','id'=>$model->parent_pages_id));

$this->params['breadcrumbs'][] = array('label' => $this->title);
?>

<?php
	if(Yii::$app->user->identity->isAdvanced):
?>

<div class="frztoolbar">
		<?= Html::a('<i class="icon-plus"> </i> '.Yii::t('app','Create'), array('create', 'id' => $model->id), array('class' => 'btn btn-success')); ?>
    &nbsp;&nbsp;<?= Html::a('<i class="icon-pencil"> </i> '.Yii::t('app','Update'), array('update', 'id' => $model->id), array('class' => 'btn btn-info')); ?>
		&nbsp;&nbsp;<?= Html::a('<i class="icon-trash"> </i> '.Yii::t('app','Delete'), array('delete', 'id' => $model->id), array('class' => 'btn btn-danger')); ?>
</div>

<?php
	endif;
?>

<?php Block::begin(array('id'=>'sidebar')); ?>

  <?php 
    if(class_exists('\frenzelgmbh\scms\widgets\PortletPageToc') && Yii::$app->user->identity->isUser){
      echo \frenzelgmbh\scms\widgets\PortletPageToc::widget(); 
    }
  ?>  

	<?php
		if(in_array("advanced",explode(';',$model->vars))){
			echo \frenzelgmbh\scms\widgets\PortletCmsToc::widget(array(
    			'rootId'=>$model->id,
    			'contentCssClass' => 'bg-color-white'
			));
		}else{
			echo \frenzelgmbh\scms\widgets\PortletPageNavigationSub::widget(array(
    		'id'=>$model->id,
			));
		}
		if(in_array("search",explode(';',$model->vars))){
			echo \frenzelgmbh\scms\widgets\PortletPagesSearch::widget();
		}
	?>

  <?php 
    if(class_exists('\frenzelgmbh\scms\widgets\PortletCmsHistory') && Yii::$app->user->identity->isUser){
      echo \frenzelgmbh\scms\widgets\PortletCmsHistory::widget(array(
        'id'=>$model->id,
      )); 
    }
  ?>

<?php Block::end(); ?>

<?php 
	if(class_exists('\app\modules\tasks\widgets\PortletTasksBatch') && Yii::$app->user->identity->isAdvanced){
		echo \app\modules\tasks\widgets\PortletTasksBatch::widget(array(
			'module'=>\app\modules\workflow\models\Workflow::MODULE_CMS,
			'id'=>$model->id,
		)); 
	}
?>

<div id="site-index">
  <div class="post-box">
    <div class="post-header">
  	 <h3 class="subline"><?= Html::encode($this->title); ?></h3>
    </div>
    <div class="post-content">
    	<?php 
    		echo HtmlPurifier::process($model->body);
    	?>
    </div>
  </div>
</div>

<?php 
  if(class_exists('\app\modules\comments\widgets\PortletComments') && !Yii::$app->user->isGuest){
    echo \app\modules\comments\widgets\PortletComments::widget(array(
      'module'=>\app\modules\workflow\models\Workflow::MODULE_CMS,
      'id'=>$model->id,
    )); 
  }
?>
