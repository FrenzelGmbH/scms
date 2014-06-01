<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<a href="<?= Url::to(array('/pages/page/onlineview', 'id' => $model->id)); ?>" class="list-group-item fg-color-orange"><i class="icon-arrow-right"></i> <?= Html::encode(strtoupper($model->title)); ?></a>
