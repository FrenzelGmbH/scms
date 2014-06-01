<?php

use yii\helpers\Html;

/**
 * @var yii\base\View $this
 * @var app\modules\pages\models\Page $model
 */

$this->title = 'Create Page';
$this->params['breadcrumbs'][] = array('label' => 'Pages', 'url' => array('index'));
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-wsp">

	<h1><?= Html::encode($this->title); ?></h1>

	<?= $this->render('_form', array(
		'model' => $model,
	)); ?>

</div>
