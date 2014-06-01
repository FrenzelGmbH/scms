<?php

namespace app\modules\pages\models;

use \Yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use app\models\User;
use app\modules\workflow\models\Workflow;
use app\modules\comments\models\Comment;
use app\modules\tags\models\Tag;

/**
 * This is the model class for table "tbl_pages".
 *
 * @property integer $id
 * @property string $name
 * @property string $body
 * @property integer $parent_pages_id
 * @property integer $ord
 * @property integer $time_create
 * @property integer $time_update
 * @property integer $special
 * @property string $title
 * @property string $template
 * @property string $category
 * @property string $tags
 * @property string $description
 * @property string $date_associated
 * @property string $vars
 * @property string $status
 */
class Page extends \yii\db\ActiveRecord
{

	/**
	* the content of the preupdated tags
	* @var string the complete tags content
	*/
	private $_oldTags;

	/**
	* the content of the preupdated body
	* @var string the complete body content
	*/
	private $_oldBody;

  /**
   * will include the custom scopes for this model
   * @return object enhanced query object
   */
  public static function find()
  {
    return new PageQuery(get_called_class());
  }

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'tbl_pages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array(['title', 'body', 'status'], 'required'),
			array('status', 'in', 'range'=>array(Workflow::STATUS_DRAFT,Workflow::STATUS_PUBLISHED,Workflow::STATUS_ARCHIVED)),
			array(['title', 'name'], 'string', 'max'=>128),
			array('parent_pages_id','integer'),
			array(['description', 'vars'],'string'),
			array('date_associated','date'),
			array('ord','integer'),
			array(['time_create', 'time_update', 'template'],'string'),
			array('special','integer'),
			array('category','integer'),
			array('tags', 'match', 'pattern'=>'/^[\w\s,]+$/', 'message'=>'Tags can only contain word characters.'),
			array('tags', 'normalizeTags'),
		);
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'body' => 'Body',
			'parent_pages_id' => 'Parent Pages ID',
			'ord' => 'Ord',
			'time_create' => 'Time Create',
			'time_update' => 'Time Update',
			'special' => 'Special',
			'title' => 'Title',
			'template' => 'Template',
			'category' => 'Category',
			'tags' => 'Tags',
			'description' => 'Description',
			'date_associated' => 'Date Associated',
			'vars' => 'Vars',
			'status' => 'Status',
		);
	}

  /**
   * returns the complete parent node of the selected page
   * @return [type] [description]
   */
  public function getParent(){
    return $this->hasOne('app\modules\pages\models\Page',array('id'=>'parent_pages_id'));
  }

	/**
	* returns the number of child nodes
	*/
	public function getNoChildren(){
		return static::find()->where('parent_pages_id = '.$this->id.' AND (special IS NULL OR special <> "-1")')->count();
	}

	/**
	 * Returns all possible lists to choose from as an associative array
	 *
	 * @return array The array of lists
	 */
	public static function getListOptions()
	{
		$returnme = array();
		$returnme[] = array('0'=>'NONE AVAILABLE! Gibts net!');
		$returnme[] = ArrayHelper::map(Page::findBySQL('SELECT DISTINCT id, name FROM tbl_pages WHERE (special IS NULL OR special <> "-1") ORDER BY name')->all(),'id','name');
		return $returnme;
	}


	/**
	* shows the comments for the current page
	* @return array related comments for this page
	*/

	public function getComments() {		
		return $this->hasMany('app\modules\comments\models\Comment', array('comment_id' => 'id'))
		            ->where('status = "'. Workflow::STATUS_APPROVED.'" AND comment_table = '.Workflow::MODULE_CMS)
					->orderBy('time_create DESC');
	}

	/**
	 * @return string the URL that shows the detail of the pages
	 */
	public function getUrl()
	{
		return Yii::$app->urlManager->createUrl([
      '/pages/page/onlineview',
			'id'=>$this->id,
			'title'=>$this->title,
		]);
	}

	/**
	 * @return string the URL that shows the update of the pages
	 */
	public function getUrlUpdate()
	{
		return Yii::$app->urlManager->createUrl([
      'pages/page/update',
			'id'=>$this->id
		]);
	}

	/**
	 * @return string the URL that shows the update of the pages
	 */
	public function getUrlDiff()
	{
		return Yii::$app->urlManager->createUrl([
      'pages/page/diffview', 
			'id'=>$this->id
		]);
	}

	/**
	 * @return array a list of links that point to the pages list filtered by every tag of this pages
	 */
	public function getTagLinks()
	{
		$links=array();
		foreach(Tag::string2array($this->tags) as $tag)
			$links[]=Html::a(Html::encode($tag), array('page/index', 'tag'=>$tag), array('class'=>'label'));
		return $links;
	}

	/**
	 * Normalizes the user-entered tags.
	 */
	public function normalizeTags($attribute,$params)
	{
		$this->tags=Tag::array2string(array_unique(Tag::string2array($this->tags)));
	}

	/**
	 * Adds a new comment to this pages.
	 * This method will set status and pages_id of the comment accordingly.
	 * @param Comment the comment to be added
	 * @return boolean whether the comment is saved successfully
	 */
	public function addComment($comment)
	{
		if(Yii::$app->params['commentNeedApproval'])
			$comment->status=Workflow::STATUS_DRAFT;
		else
			$comment->status=Workflow::STATUS_APPROVED;
		$comment->comment_table=Workflow::MODULE_CMS;
		$comment->comment_id=$this->id;
		return $comment->save();
	}

	/**
	 * This is invoked when a record is populated with data from a find() call.
	 */
	public function afterFind()
	{
		parent::afterFind();
		$this->_oldTags=$this->tags;
		$this->_oldBody=$this->body;
	}

	/**
	 * This is invoked before the record is saved.
	 * @return boolean whether the record should be saved.
	 */
	public function beforeSave($insert)
	{
		if (parent::beforeSave($insert)) {
			if ($insert) {
				$this->time_create=$this->time_update=time();
			}
			else {
				$this->time_update=time();
        $this->date_associated = date('Y-m-d');
				//here we check if the body has changed
				if($this->body != $this->_oldBody){
					$OldPage = new Page; //looks strange, but the old page needs to be backuped into a new one;)
					$OldPage->body = $this->_oldBody;
					$OldPage->title = $this->title;
					$OldPage->name = $this->name;
					$OldPage->tags = $this->_oldTags;
					$OldPage->parent_pages_id = $this->id;
					$OldPage->special = -1; //means its a none normal page
					$OldPage->status = Workflow::STATUS_ARCHIVED;
					$OldPage->save();
				}
			}
			return true;
		} else {
			return false;
		}
	}

	/**
	 * This is invoked after the record is saved.
	 */
	public function afterSave($insert)
	{
		parent::afterSave($insert);
		Tag::updateFrequency($this->_oldTags, $this->tags);
	}

	/**
	 * This is invoked after the record is deleted.
	 */
	public function afterDelete()
	{
		if (parent::beforeDelete()) {
			Comment::deleteAll('comment_id='.$this->id.' AND comment_table="'.$this->tableName().'"');
			Tag::updateFrequency($this->tags, '');
		} else {
			return false;
		}
	}

	/**
	* returns the parent nodes for the menu
	*/

	public static function getRootNodes()
	{
		return self::find()->where('parent_pages_id = 0')->active()->orderBy('ord')->all();
	}

	/**
     * Forms an associative, multidimensional array holding only the first
     * level of nodes. Used when lazy loading is enabled and only the first
     * nodes should be shown.
     * 
     * @param int dataview_id The id of the dataview to show this tree for
     * @param User $user The user model to filter this tree for (Defaults to false, meaning no user filter)
     *
     * @return array The parent child data as associative, multidimensional array
     */
    public static function rootTreeAsArray($id)
    {
    	$checkRootNode = Page::findOne($id);
    	if(is_null($checkRootNode->parent_pages_id) OR $checkRootNode->parent_pages_id == 0)
    		$rootNode = $checkRootNode->id;
    	else
    		$rootNode = $checkRootNode->parent_pages_id;

    	$roots = array();
    	$roots = Page::find()->where(array('id' => $rootNode))->All();
		$out = array();
        foreach($roots as $root)
        {        	
        	$currow = array('id'=>$root->id,'child' => $root->noChildren,'text'=>$root->name);
        	$out[]=$currow;
        }
        return $trees = array('id' => 0,'item' => $out);
    }

    /**
     * Returns the children of a given node as associative array
     *
     * @param int $id The id of the parent node
     * @return array an associative array holding the children of the given node
     */
    public static function nodeChildren($id,$lazyLoad = false)
    {
        $curnode = static::findOne($id);
        if($curnode)
        {
            $children = static::find()->where('parent_pages_id = '.$id.' AND (special IS NULL OR special <> "-1")')->All();
            if(sizeOf($children)>0)
            {
                $out = array();
            	foreach($children as $child)
                {
                	if($child->noChildren>0)
                	{
                		$currow=array('id'=>$child->id,'text'=>$child->name,'child'=>1);
                	}
                	else
                	{
                		$currow=array('id'=>$child->id,'text'=>$child->name);
                	}
                	$out[] = $currow;
                }
                return array('id' => $id,'item' => $out);
            }
            else
            {
            	return array();
            }
        }
        return array();
    }

  /**
  * search body by string
  * @param string searchText to be looked up
  */
  public static function searchByString($query)
  {
		return static::find()->where("UPPER(body) LIKE '%".strtoupper($query)."%' AND (special IS NULL OR special <> '-1')");
	}

	/**
	* historical versions
	* return all old versions
	*/
	public static function findOldVersions($id)
	{
		return static::find()->where('parent_pages_id = '.$id.' AND special = "-1"')
					->orderBy('time_create DESC'); 
	}

  /**
   * This will return the query the passed number of posts ordered desc by time created
   * 
   * @param  limit number of records to be listed by data provider
   * @return  query containing the correct sql for active data provider
   */
  
  public static function getAdapterForSubmenu($id, $limit=5)
  {
    return static::find()->where('parent_pages_id="'.$id.'"')
          ->active()
          ->orderBy('title ASC')
          ->limit($limit);
  } 
}
