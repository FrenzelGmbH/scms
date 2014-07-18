<?php
namespace frenzelgmbh\scms\widgets;

use \Yii;
use yii\helpers\Html;

use frenzelgmbh\scms\models\Page;
use frenzelgmbh\appcommon\widgets\Portlet;

class PortletCmsHistory extends Portlet
{
	public $title='Verlauf';
	
	public $id = 0;
	public $enableAmdin = false;

	public function init() {
		parent::init();
	}

	protected function renderContent()
	{
		$historics = Page::findOldVersions($this->id)->All();
		echo $this->render('@frenzelgmbh/scms/widgets/views/portlet_cms_history',array('historics'=>$historics));
	}
}