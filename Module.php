<?php

namespace frenzelgmbh\scms;

use yii\base\Module as BaseModule;

/**
 * Smart Content Management Module for Yii2
 *
 * @author Philipp frenzel <philipp@frenzel.net>
 */
class Module extends BaseModule {

    const VERSION = '0.1.0-dev';

    /**
     * @var string|null View path. Leave as null to use default "@user/views"
     */
    public $viewPath;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->setAliases([
            '@scms' => dirname(__FILE__)
        ]);
        \Yii::$app->i18n->translations['scms'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@frenzelgmbh/scms/messages',
        ];
        //get the displayed view and register the needed assets
        //as we have no view in this context we need to make the way over the $app->view
        scmsAsset::register(\Yii::$app->view);
    }
    
}
