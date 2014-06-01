<?php

namespace app\modules\pages\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\pages\models\Page;

/**
 * PageForm represents the model behind the search form about Page.
 */
class PageForm extends Model
{
	public $id;
	public $name;
	public $body;
	public $parent_pages_id;
	public $ord;
	public $time_create;
	public $time_update;
	public $special;
	public $title;
	public $template;
	public $category;
	public $tags;
	public $description;
	public $date_associated;
	public $vars;
	public $status;

	public function rules()
	{
		return array(
			array(['id', 'parent_pages_id', 'ord', 'time_create', 'time_update', 'special'], 'integer'),
			array(['name', 'body', 'title', 'template', 'category', 'tags', 'description', 'date_associated', 'vars', 'status'], 'safe'),
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

	public function search($params)
	{
		$query = Page::find();
		$dataProvider = new ActiveDataProvider(array(
			'query' => $query,
		));

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$this->addCondition($query, 'id');
		$this->addCondition($query, 'name', true);
		$this->addCondition($query, 'body', true);
		$this->addCondition($query, 'parent_pages_id');
		$this->addCondition($query, 'ord');
		$this->addCondition($query, 'time_create');
		$this->addCondition($query, 'time_update');
		//$this->addCondition($query, 'special');
		$this->addCondition($query, 'title', true);
		$this->addCondition($query, 'template', true);
		$this->addCondition($query, 'category', true);
		$this->addCondition($query, 'tags', true);
		$this->addCondition($query, 'description', true);
		$this->addCondition($query, 'date_associated');
		$this->addCondition($query, 'vars', true);
		$this->addCondition($query, 'status', true);
		return $dataProvider;
	}

	protected function addCondition($query, $attribute, $partialMatch = false)
  {
    if (($pos = strrpos($attribute, '.')) !== false) {
      $modelAttribute = substr($attribute, $pos + 1);
    } else {
      $modelAttribute = $attribute;
    }

    $value = $this->$modelAttribute;
    if (trim($value) === '') {
      return;
    }
    if ($partialMatch) {
      $query->andWhere(['like', $attribute, $value]);
    } else {
      $query->andWhere([$attribute => $value]);
    }
  }

}
