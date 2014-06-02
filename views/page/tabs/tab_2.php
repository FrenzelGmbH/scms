<div class="row">
  <div class="col-md-6">
    <?= $form->field($model, 'tags')->textInput(array('size'=>50)); ?>    
  </div>
  <div class="col-md-6">
    <?= $form->field($model, 'category')->textInput(array('maxlength' => 64)); ?>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <?= $form->field($model, 'description')->textarea(array('rows' => 2)); ?>  
  </div>
</div>
    