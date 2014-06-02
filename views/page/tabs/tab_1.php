<?php

use app\modules\workflow\models\Workflow;

?>

<div class="row">
  <div class="col-md-6">
    <?= $form->field($model,'title')->textInput(array('size'=>80,'maxlength'=>128,'class'=>'form-control tipster','title'=>'Titel der Seite')); ?>    
  </div>
  <div class="col-md-6">
    <?= $form->field($model,'name')->textInput(array('size'=>80,'maxlength'=>128)); ?>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <?= $form->field($model, 'status')->dropDownList(Workflow::getStatusOptions()); ?>
  </div>
  <div class="col-md-6">
    <?= $form->field($model, 'parent_pages_id')->dropDownList($model::getListOptions()); ?>
  </div>
</div>
