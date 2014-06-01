<?php

use yii\helpers\Html;

?>

<div class="post-box">
  <h4 class="fg-color-orange"><?= Html::encode(strtoupper($model->title)); ?></h4>
  <?= nl2br(Html::encode($model->content)); ?>
</div>
