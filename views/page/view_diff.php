<?php
use \Yii;

use yii\widgets\Block;
use yii\helpers\Html;

use yii\widgets\Breadcrumbs;
use yii\bootstrap\Collapse;

$this->registerAssetBundle('yii\gii\GiiAsset');

if(!is_null($model->parent->title))
	$this->params['breadcrumbs'][] = array('label' => $model->parent->title, 'url' => array('/pages/page/onlineview','id'=>$model->parent_pages_id));

$this->params['breadcrumbs'][] = array('label' => $model->title);

?>

<?php Block::begin(array('id'=>'sidebar')); ?>
	
	<?php
		if(in_array("advanced",explode(';',$model->vars))){
			echo app\modules\pages\widgets\PortletCmsToc::widget(array(
    			'rootId'=>$model->id,
    			'contentCssClass' => 'bg-color-white'
			));
		}else{
			echo app\modules\pages\widgets\PortletPageNavigationSub::widget(array(
    		'id'=>$model->id,
			));
		}
		if(in_array("search",explode(';',$model->vars))){
			echo app\modules\pages\widgets\PortletPagesSearch::widget();
		}
	?>

<?php Block::end(); ?>

<?= Breadcrumbs::widget(array(
			'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : array(),
		)); ?>

<h3>Changes</h3>

<div class="default-diff">
	<?php if ($difftext === false): ?>
		<div class="alert alert-danger">Diff is not supported for this file type.</div>
	<?php elseif (empty($difftext)): ?>
		<div class="alert alert-success">Identical.</div>
	<?php else: ?>
		<?= $difftext; ?>
	<?php endif; ?>
</div>