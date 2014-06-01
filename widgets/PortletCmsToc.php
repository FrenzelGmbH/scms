<?php
namespace app\modules\pages\widgets;

use \Yii;
use yii\helpers\Html;
use frenzelgmbh\appcommon\widgets\Portlet;

class PortletCmsToc extends Portlet
{
  public $title='Content Navigation';
  
  public $rootId = 0;

  public $htmlOptions=array();

  /**
   * @var string the CSS class for the portlet title tag. Defaults to 'portlet-title'.
   */
  public $titleCssClass='panel-title';

  public function init() {
    parent::init();
  }

  protected function renderContent()
  {
    echo $this->render('@app/modules/pages/widgets/views/portlet_cms_toc',array('rootId'=>$this->rootId));
  }
}