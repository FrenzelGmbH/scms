<?php
namespace frenzelgmbh\scms\widgets;

use Yii;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;

use frenzelgmbh\appcommon\widgets\Portlet;
use frenzelgmbh\scms\models\Page;

class PortletPageNavigationSub extends Portlet
{
	public $title='Themen';
	
	/**
	 * @var integer number of menu entries that will be displayed
	 */
	public $limit = 100;

	/**
	 * here we set the id of the current page, to which we will fetch all children
	 * @var integer the pk of the currently displayed record
	 */
	public $id = 1;

	/**
	 * @var string the CSS class for the portlet title tag. Defaults to 'portlet-title'.
	 */
	public $titleCssClass='fg-color-white bg-color-orangepic smallspace';

	public $contentCssClass;

	public $htmlOptions=array();

	public function init() {
		parent::init();
	}

	protected function renderContent()
	{
		$query = Page::getAdapterForSubmenu($this->id,$this->limit);

		$dpSubmenu = new ActiveDataProvider(array(
		      'query' => $query,
		      'pagination' => array(
		          'pageSize' => 100,
		      ),
	  	));
		//here we don't return the view, here we just echo it!
		echo $this->render('@frenzelgmbh/scms/widgets/views/_submenu',array('dpSubmenu'=>$dpSubmenu));
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
			echo "<h4 class=\"{$this->titleCssClass}\"><i class='icon-list-alt'></i> {$this->title}</h4>\n";
		}
	}
}