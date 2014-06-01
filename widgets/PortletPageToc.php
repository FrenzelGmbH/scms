<?php
namespace app\modules\pages\widgets;

use \Yii;
use yii\helpers\Html;

use app\modules\pages\models\Page;
use frenzelgmbh\appcommon\widgets\Portlet;

class PortletPageToc extends Portlet
{
	public $title='Navigator';
	
	public $enableAmdin = false;

	public function init() {
		parent::init();
	}

	protected function renderContent()
	{
		echo $this->render('@app/modules/pages/widgets/views/portlet_pages_toc');
	}
}