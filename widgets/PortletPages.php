<?php
namespace app\modules\pages\widgets;

use Yii;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;

use frenzelgmbh\appcommon\widgets\Portlet;
use app\modules\pages\models\Page;

class PortletPages extends Portlet
{
	public $title='Content';
	
	public $limit = 3;

	/**
	 * @var string the CSS class for the portlet title tag. Defaults to 'portlet-title'.
	 */
	public $titleCssClass='fg-color-white';

	public $contentCssClass='fg-color-black';

	public $htmlOptions=array();

	public function init() {
		parent::init();
	}

	protected function renderContent()
	{
		$query = Page::getAdapterForPages($this->limit);

		$dpPages = new ActiveDataProvider(array(
		      'query' => $query,
		      'pagination' => array(
		          'pageSize' => 10,
		      ),
	  	));
		//here we don't return the view, here we just echo it!
		echo $this->render('@app/modules/pages/widgets/views/_pages',array('dpPages'=>$dpPages));
	}

	/**
	 * Renders the decoration for the portlet.
	 * The default implementation will render the title if it is set.
	 */
	protected function renderDecoration()
	{
		if($this->title!==null)
		{
			$this->title = Yii::t('app',$this->title);
			echo "<div class='panel-heading'><h3 class=\"{$this->titleCssClass}\"><i class='icon-info'></i> {$this->title}</h3>\n</div>\n";
		}
	}
}