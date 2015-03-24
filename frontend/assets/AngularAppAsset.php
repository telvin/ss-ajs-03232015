<?php

namespace frontend\assets;
use yii\web\AssetBundle;

class AngularAppAsset extends AssetBundle
{
    /**
     * @sourcePath specifies the root directory that contains the asset files in this bundle. This property should be set if the root directory is not Web accessible. Otherwise, you should set the basePath property
     */
    public $baseUrl = '@web/angularjs/';
    public $basePath = '@webroot/angularjs/';

    public $js = [
        'app/apps/yiiapp.js',
        'app/routes.js',

        //services
        'app/services/helper.js',
        'app/services/yii-data.js',

        //directives - common
        'app/directives/common/header-1.js',
        'app/directives/common/nav-item.js',

        //directives - partials
        'app/directives/partials/non-user-top-nav.js',

    ];

    public $jsOptions = [ 'position' => \yii\web\View::POS_HEAD ];

    public $css = [

    ];

    public $depends = [
        'frontend\assets\AngularAsset',
    ];
}