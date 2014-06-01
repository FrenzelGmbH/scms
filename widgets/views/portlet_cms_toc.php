<?php

use \Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yiidhtmlx\Tree;
use yiidhtmlx\Menu;

$this->registerAssetBundle('yiidhtmlx\WidgetAsset');

$jumpTarget = Url::to(array('/pages/page/onlineview','id'=>''));
$actionTarget = Url::to(array('/pages/page'));
$jumpJS = <<<JUMPSS

function doOnRowSelect(id,ind) {
  window.location = "$jumpTarget"+id; 
};

function doOnMenuSelect(id,type) {
  var NodeId = dhtmlxmyCMSTree.contextID;
  window.location = '$actionTarget/'+id+'&id='+NodeId;
};
JUMPSS;
$this->registerJs($jumpJS);

?>

<?php

$imgPath = Yii::$app->assetManager->getBundle('yiidhtmlx\WidgetAsset')->baseUrl . "/dhtmlxTree/imgs/csh_dhx_terrace/";
$imgMenuPath = Yii::$app->assetManager->getBundle('yiidhtmlx\WidgetAsset')->baseUrl . "/dhtmlxMenu/imgs/dhxmenu_dhx_terrace/";

echo Menu::widget(
  array(
    'clientOptions'=>array(
      'parent' => 'myCMSTreeMenu',
      'skin' => "dhx_terrace",
      'context' => true,
      'image_path' => $imgMenuPath,
      'items' => array(
        array('id'=>'create','text'=>'Create new Child','img'=>'img/dhtmlx/s4.gif'),
        array('id'=>'viewparent','text'=>'Go to Parent','img'=>'img/dhtmlx/s3.gif')
      )
    ),      
      'options'=>array(
      'id'    => 'myCMSTreeMenu',
    ),
    'clientEvents'=>array(
      'onClick' => 'doOnMenuSelect',
    )   
  )
);

echo Tree::widget(
  array(
    'enableContextMenu'=>'dhtmlxmyCMSTreeMenu',
    'clientOptions'=>array(
      'parent' => 'myCMSTree',
      'skin' => "terrace",
      'image_path' => $imgPath,
      'width' => '100%',
      'height' => '200px',
      'checkbox' => false,
      'smart_parsing' => true,
    ),      
      'options'=>array(
      'id'    => 'myCMSTree',
    ),
    'clientDataOptions'=>array(
      'type'=>'json',
      'url'=>Url::to(array('/pages/page/jsontreeview','rootId'=>$rootId))
    ),
    'clientEvents'=>array(
      'onClick' => 'doOnRowSelect',
    )   
  )
);
?>
