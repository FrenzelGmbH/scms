<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\base\View $this
 * @var app\modules\pages\models\Page $model
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = array('label' => 'Pages', 'url' => array('index'));
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-wsp">

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
			'time_create:datetime',
			'time_update:datetime',
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
