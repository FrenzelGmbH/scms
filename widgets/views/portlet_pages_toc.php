<?php

use philippfrenzel\yiijquerytoc\yiijquerytoc;

?>

<?php

echo yiijquerytoc::widget(
	array(
		'context' => '#onlineviewwrap',
		'clientOptions' => array(
			'smoothScroll' => false,
			'theme' => 'none',
		),	
	  'options'=>array(
			'id'    => 'pagetoccmspage',		
		),
	)
);
?>
