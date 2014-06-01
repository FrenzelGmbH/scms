<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

?>

<?php 
	echo HtmlPurifier::process($model->body);
?>
