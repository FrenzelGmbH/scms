<?php

use yii\widgets\ActiveForm;
use yii\helpers\Json;
use yii\web\JsExpression;

use kartik\helpers\Html;
use yii\helpers\Url;

use app\modules\workflow\models\Workflow;
use philippfrenzel\yiiwymeditor\yiiwymeditor;

/**
 * @var yii\base\View $this
 * @var app\modules\pages\models\Page $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="page-form">

	<?php $form = ActiveForm::begin(); ?>

<div class="row">
	<div class="col-lg-12">
		<?= $form->field($model,'title')->textInput(array('size'=>80,'maxlength'=>128,'class'=>'form-control tipster','title'=>'Titel der Seite')); ?>
		<?= $form->field($model,'name')->textInput(array('size'=>80,'maxlength'=>128)); ?>		
	</div>
</div>

<div class="row">
	<div class="col-lg-4">
		<?= $form->field($model, 'parent_pages_id')->dropDownList($model::getListOptions()); ?>
		<?= $form->field($model, 'description')->textarea(array('rows' => 2)); ?>
		<?= $form->field($model, 'tags')->textInput(array('size'=>50)); ?>
		<?= $form->field($model, 'status')->dropDownList(Workflow::getStatusOptions()); ?>
		<?= $form->field($model, 'template')->textarea(array('rows' => 2)); ?>
		<?= $form->field($model, 'vars')->textInput(); ?>
		<?= $form->field($model, 'ord')->textInput(); ?>
		<?= $form->field($model, 'special')->textInput(); ?>
		<?= $form->field($model, 'date_associated')->textInput(); ?>
		<?= $form->field($model, 'category')->textInput(array('maxlength' => 64)); ?>
		<?= $form->field($model, 'time_create')->textInput(); ?>
		<?= $form->field($model, 'time_update')->textInput(); ?>
	</div>
	<div class="col-lg-8">

	<?php

$pinterest = <<< SCRIPT
{instanceReady: function() {
  this.dataProcessor.htmlFilter.addRules({
      elements: {
          img: function( el ) {
              if ( !el.attributes.class )
                el.attributes.class = 'img-responsive';
              if(el.attributes.alt == 'pinterest') {
                var fragment = CKEDITOR.htmlParser.fragment.fromHtml( '<div class="pinterest-image">'+el.getOuterHtml()+'</div>' );
                el.replaceWith(fragment);
              }
          }
      }
  });          
}}
SCRIPT;

?>

		<?= yiiwymeditor::widget(array(
			'model'=>$model,
			'attribute'=>'body',
			'clientOptions'=>array(
				'on' => new JsExpression($pinterest),
				'toolbar' => 'basic',
				'height' => '400px',
				'filebrowserBrowseUrl' => Url::to(array('/pages/page/filemanager')),
				'filebrowserImageBrowseUrl' => Url::to(array('/pages/page/filemanager','mode'=>'image')),
			),
			'inputOptions'=>array(
				'size'=>'2',
			)
		));?>
	</div>
</div>
		
		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', array('class' => 'btn btn-primary')); ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
