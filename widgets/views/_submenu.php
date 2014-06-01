<?php

use yii\helpers\Html;
use yii\widgets\ListView;

?>

<div class="list-group">
<?php 
	echo ListView::widget(array(
		'id' => 'PortletPageSubmenu',
		'dataProvider'=>$dpSubmenu,
		'itemView' => 'iviews/_menu_item',
		'layout' => '{items}',
		)
	);
?>
</div>
