scms
====

SMART Content Management Module

Installation
============

Install package via composer "frenzelgmbh/scms": "dev-master"

Update config file *config/web.php* and *config/db.php*

```php
// app/config/web.php
return [
    'modules' => [
        'pages' => [
            'class' => 'frenzelgmbh\scms\Module',
            // set custom module properties here ...
        ],
    ],
];
// app/config/db.php
return [
        'class' => 'yii\db\Connection',
        // set up db info
];
```

Run migration file
php yii migrate --migrationPath=@vendor/frenzelgmbh/scms/migrations

Widgets
=======

To use the blog, you can implement the following widgets:

Widget for Picture Links (can be used to include advertisement links)
* MODULE (e.g. STARTPAGE)
* ID (1)
* Picture (needs to be uploaded)
* Link (whatever you wanna link to)
```php 
if(class_exists('frenzelgmbh\scms\widgets\WidgetPictureLink')){
  echo frenzelgmbh\scms\widgets\WidgetPictureLink::widget([
    'title'=>NULL,
    'limit'=>20,
  ]); 
}
```

This Widget renders all posts in descendending order which is based upon the creation date of the posts.
```php
if(class_exists('frenzelgmbh\scms\widgets\PortletPostsStyled')){
  echo frenzelgmbh\scms\widgets\PortletPostsStyled::widget([
  'title'=>NULL,
    'limit'=>4,
  ]); 
}
```