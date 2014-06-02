<?php

use kartik\widgets\ActiveForm;
use yii\helpers\Json;
use yii\web\JsExpression;

use kartik\helpers\Html;
use yii\helpers\Url;

use app\modules\workflow\models\Workflow;
use philippfrenzel\yiiwymeditor\yiiwymeditor;

use yii\bootstrap\Tabs;

/**
 * @var yii\base\View $this
 * @var frenzelgmbh\scms\models\Page $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="page-form">

  <?php $form = ActiveForm::begin(); ?>

  <?php
echo Tabs::widget([
    'items' => [
        [
            'label' => 'Main Settings',
            'content' => $this->render('tabs/tab_1', ['model' => $model,'form'=>$form]),
            'active' => true
        ],
        [
            'label' => 'Content Description',
            'content' => $this->render('tabs/tab_2', ['model' => $model,'form'=>$form])
        ],
        [
            'label' => 'Layout Settings',
            'content' => $this->render('tabs/tab_3', ['model' => $model,'form'=>$form])
        ]
    ],
]);
?>

<div class="row">
  <div class="col-md-12">
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
    
  <div class="form-group navbar navbar-default">
    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', array('class' => 'btn btn-info navbar-btn tipster','title'=>'update this record')); ?>
  </div>

  <?php ActiveForm::end(); ?>

</div>
