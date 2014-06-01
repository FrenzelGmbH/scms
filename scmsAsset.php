<?php
/**
 * @link http://www.frenzel.net/
 * @author Philipp Frenzel <philipp@frenzel.net> 
 */

namespace frenzelgmbh\scms;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class scmsAsset extends AssetBundle
{
    public $sourcePath = '@frenzelgmbh/scms/assets';
    
    public $css = [
        'css/scms.css'
    ];
    
    public $js = [];
    
    public $depends = [];
}
