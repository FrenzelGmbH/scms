<?php

/**
 * The migration script for the scms
 * @author Philipp Frenzel <philipp@frenzel.net>
 * @copyright Frenzel GmbH
 * @version 1.0
 */

use yii\db\Schema;

class m140601_050429_pagetables extends \yii\db\Migration
{
	public function up()
	{
		
		switch (Yii::$app->db->driverName) {
	      case 'mysql':
	        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
	        break;
	      case 'pgsql':
	        $tableOptions = null;
	        break;
	      default:
	        throw new RuntimeException('Your database is not supported!');
	    }

		$this->createTable('{{%pages}}',array(
				'id'              => Schema::TYPE_PK,
				'name'            => Schema::TYPE_TEXT,
				'body'            => Schema::TYPE_TEXT,
				'ord'             => Schema::TYPE_INTEGER.' 0',
				'time_create'     => Schema::TYPE_INTEGER,
				'time_update'     => Schema::TYPE_INTEGER,
				'special'         => Schema::TYPE_INTEGER.'(20) DEFAULT NULL',
				'title'           => Schema::TYPE_STRING.'(128) NOT NULL',
				'template'        => Schema::TYPE_STRING,
				'category'        => Schema::TYPE_STRING.'(64) DEFAULT NULL',
				'description'     => Schema::TYPE_STRING,
				'date_associated' => Schema::TYPE_DATE .' DEFAULT NULL',
				'vars'            => Schema::TYPE_STRING,
				'tags'            => Schema::TYPE_STRING,
				'status'          => Schema::TYPE_STRING .'(255) NOT NULL DEFAULT "created"',
				//possible reference to user
      	'user_id'           => Schema::TYPE_INTEGER.' NULL',
      	//module fields
      	'mod_table'         => Schema::TYPE_STRING .'(100)',
      	'mod_id'            => Schema::TYPE_INTEGER.' NULL',
      	//interface fields
      	'system_key'        => Schema::TYPE_STRING .'(100)',
      	'system_name'       => Schema::TYPE_STRING .'(100)',
      	'system_upate'      => Schema::TYPE_INTEGER.' DEFAULT NULL',
      	// timestamps
      	'created_at'        => Schema::TYPE_INTEGER . ' NOT NULL',
      	'updated_at'        => Schema::TYPE_INTEGER . ' NOT NULL',
      	'deleted_at'        => Schema::TYPE_INTEGER . ' DEFAULT NULL',
      	//Foreign Keys
      	'author_id'     	  => Schema::TYPE_INTEGER.' NULL',
      	'parent_pages_id'   => Schema::TYPE_INTEGER.' NULL'
		),$tableOptions);

		/**
		* Add all needed fields to user in one_site belongs to many users
		**/
		$this->addForeignKey('FK_pages_author','{{%pages}}','author_id','{{%user}}','id');
	}

	public function down()
	{
		//drop FK's first
		$this->dropForeignKey('FK_pages_author','{{%pages}}');
		
		$this->dropTable('{{%pages}}');
	}
}
