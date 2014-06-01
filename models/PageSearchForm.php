<?php

namespace app\modules\pages\models;

use \Yii;
use yii\base\Model;

use app\components\UserIdentity;

/**
 * LoginForm is the model behind the login form.
 */
class PageSearchForm extends Model
{
	public $searchstring;
	
	/**
	 * @return array the validation rules.
	 */
	public function rules()
	{
		return array(
			// username and password are both required
			array('searchstring', 'string'),
		);
	}

}
