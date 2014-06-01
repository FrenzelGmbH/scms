<?php
namespace app\modules\pages\widgets;

use Yii;
use yii\helpers\Html;

use app\modules\pages\models\Page;
use app\modules\pages\models\PageSearchForm;

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
		echo $this->render('@app/modules/pages/widgets/views/_search',array('model'=>$model,'hits'=>$hits));
	}
}