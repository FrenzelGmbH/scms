<?php
use yii\helpers\Html;

use yii2elfinder\yii2elfinder;
use yii\web\JsExpression;

/**
 * @var yii\base\View $this
 */
$this->title = 'File Manager';

$ckfinder = <<<DEL

function getUrlParam(paramName) {
    var reParam = new RegExp('(?:[\?&]|&amp;)' + paramName + '=([^&]+)', 'i') ;
    var match = window.location.search.match(reParam) ;
    
    return (match && match.length > 1) ? match[1] : '' ;
}

var funcNum = getUrlParam('CKEditorFuncNum');

DEL;
$this->registerJs($ckfinder);

?>

<?php

echo yii2elfinder::widget(
  array(
    'id' => 'myElFilemanager',
    'connectorRoute' => '/pages/page/connector', 
    'clientOptions' => array(
            'getFileCallback' => new JsExpression('function(file){window.opener.CKEDITOR.tools.callFunction(funcNum, file.url);window.close();}'),
      'resizable'=>false,
            'uiOptions' => array(
                'toolbar' => array(
                    // toolbar configuration
                    ['open'],
                    ['back', 'forward'],
                    ['reload'],
                    ['home', 'up'],
                    ['mkdir', 'mkfile', 'upload'],
                    ['info'],
                    ['quicklook'],
                    ['copy', 'cut', 'paste'],
                    ['rm'],
                    ['duplicate', 'rename', 'edit'],
                    ['extract', 'archive'],
                    ['search'],
                    ['view'],
                    ['help']
                )
            ),
            'contextmenu' => array(
                // current directory menu
                'cwd' => array(
                    'reload', 'back', '|', 'upload', 'mkdir', 'mkfile', 'paste', '|', 'info'
                ),
                'files'  => array(
                    'getfile', '|','open', '|', 'copy', 'cut', 'paste', 'duplicate', '|',
                    'rm', '|', 'edit', 'rename', '|', 'archive', 'extract', '|', 'info'
                )
            ),
            'dragUploadAllow' => true,
        )
  )
);

?>