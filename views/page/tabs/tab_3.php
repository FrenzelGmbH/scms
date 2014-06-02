<div class="row">
  <div class="col-md-6">
    <?= $form->field($model, 'template')->textarea(array('rows' => 1)); ?>
  </div>
  <div class="col-md-6">
    <?= $form->field($model, 'vars')->textInput(); ?>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <?= $form->field($model, 'special')->textInput(); ?>
  </div>
  <div class="col-md-6">
    <?= $form->field($model, 'ord')->textInput(); ?>
  </div>
</div>
