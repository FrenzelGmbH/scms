<?php
namespace frenzelgmbh\scms\widgets;

use \Yii;
use yii\helpers\Html;

use frenzelgmbh\scms\models\Page;
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
		echo $this->render('@scms/widgets/views/portlet_pages_toc');
	}
}