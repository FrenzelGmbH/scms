<?php
namespace frenzelgmbh\scms\widgets;

use Yii;
use yii\helpers\Html;

use frenzelgmbh\scms\models\Page;
use frenzelgmbh\scms\models\PageSearchForm;

use frenzelgmbh\appcommon\widgets\Portlet;

class PortletPagesSearch extends Portlet
{
	public $title='Page Search';
	
	public $maxResults = 5;

	public $enableAdmin = false;

	public function init() {
		parent::init();
	}

	protected function renderContent()
	{
		$hits = NULL;
		$model = new PageSearchForm;
		if ($model->load(Yii::$app->request->post()))
		{
			if($model->searchstring!=='')
				$hits = Page::searchByString($model->searchstring)->all();
		}
		echo $this->render('@frenzelgmbh/scms/widgets/views/_search',array('model'=>$model,'hits'=>$hits));
	}
}