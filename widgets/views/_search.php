<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(array(
	'options' => array('class' => 'form-search')
)); 
?>

   <?= $form->field($model,'searchstring',array(
      'template' => "<div class=\"input-group\">{input}<span class=\"input-group-btn\"><button type=\"submit\" class=\"btn\">Go</button></span></div>\n"
      ))->textInput(array('placeholder'=>'Stichwort')); 
  ?>

<?php ActiveForm::end(); ?>

<?php

if(!is_Null($hits)){
	foreach($hits as $hit) {
		echo $this->render('iviews/_search_result_portlet',array('data'=>$hit,'searchText'=>$model->searchstring));
	}
}elseif(strlen($model->searchstring)>0){
	echo "no results found!";
}
