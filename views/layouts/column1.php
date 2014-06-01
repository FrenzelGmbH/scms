<?php $this->beginContent('@app/views/layouts/'.\frenzelgmbh\appcommon\controllers\AppController::mainlayout.'.php'); ?>
<div id="content">
  <div class="cms">
    <?= $content; ?>
  </div>
</div><!-- container -->
<?php $this->endContent(); ?>
