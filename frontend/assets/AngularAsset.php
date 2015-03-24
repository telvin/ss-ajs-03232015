<?php

namespace frontend\assets;
use yii\web\AssetBundle;

class AngularAsset extends AssetBundle
{
    /**
     * @sourcePath specifies the root directory that contains the asset files in this bundle. This property should be set if the root directory is not Web accessible. Otherwise, you should set the basePath property
     */
    public $baseUrl = '@web/angularjs/';
    public $basePath = '@webroot/angularjs/';

    public $js = [
        'lib/angular-1.3.14/angular.min.js',
        'lib/ui-bootstrap-tpls-0.11.2.min.js',
        'lib/angular-1.3.14/angular-route.min.js',
        'lib/angular-1.3.14/angular-animate.min.js',
        'lib/angular-1.3.14/angular-cookies.min.js',
        'lib/angular-1.3.14/angular-loader.min.js',
        'lib/angular-1.3.14/angular-mocks.js',
        'lib/angular-1.3.14/angular-resource.min.js',
        'lib/angular-1.3.14/angular-sanitize.min.js',
        //'lib/angular-1.3.14/angular-scenario.js',
        'lib/angular-1.3.14/angular-touch.min.js'
    ];

    public $jsOptions = [ 'position' => \yii\web\View::POS_HEAD ];
}