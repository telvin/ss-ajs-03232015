<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" ng-app="<?= Yii::$app->view->params['ngApp'] ?>">
<head>
    <!--<base href="/signsmart_angularjs/index.html" />-->
    <script>
        document.write('<base href="' + document.location + '" />');
    </script>

    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

<!--    \Yii::$app->request->BaseUrl-->
    <link rel="stylesheet" href="<?= \Yii::$app->request->BaseUrl ?>/angularjs/css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="<?= \Yii::$app->request->BaseUrl ?>/angularjs/css/custom.css" type="text/css" />
    <link rel="stylesheet" href="<?= \Yii::$app->request->BaseUrl ?>/angularjs/css/font-awesome.min.css" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>


    <!-- Global settings: required -->
    <?php echo $this->render('global-settings', ['app' => \Yii::$app]) ?>

    <!-- Libraries -->
    <script src="<?= \Yii::$app->request->BaseUrl ?>/angularjs/lib/angular-1.3.14/angular.min.js"></script>
    <script src="<?= \Yii::$app->request->BaseUrl ?>/angularjs/lib/ui-bootstrap-tpls-0.11.2.min.js"></script>
    <script src="<?= \Yii::$app->request->BaseUrl ?>/angularjs/lib/angular-1.3.14/angular-route.min.js"></script>
    <script src="<?= \Yii::$app->request->BaseUrl ?>/angularjs/lib/angular-1.3.14/angular-animate.min.js"></script>

    <!-- AngularJS custom codes -->
    <script src="<?= \Yii::$app->request->BaseUrl ?>/angularjs/app/apps/yiiapp.js"></script>

    <!-- routes -->
    <script src="<?= \Yii::$app->request->BaseUrl ?>/angularjs/app/routes/route-1.js"></script>

    <!-- services -->
    <script src="<?= \Yii::$app->request->BaseUrl ?>/angularjs/app/services/helper.js"></script>

    <script src="<?= \Yii::$app->request->BaseUrl ?>/angularjs/app/yii-data.js"></script>

    <!-- directives -->
    <script src="<?= \Yii::$app->request->BaseUrl ?>/angularjs/app/directives.js"></script>
    <script src="<?= \Yii::$app->request->BaseUrl ?>/angularjs/app/directives/header-1.js"></script>


    <!-- controllers -->
    <script src="<?= \Yii::$app->request->BaseUrl ?>/angularjs/app/controllers/pagesController.js"></script>

    <!-- Some Bootstrap Helper Libraries -->
    <script src="<?= \Yii::$app->request->BaseUrl ?>/angularjs/lib/jquery/jquery-1.10.2.min.js"></script>
    <script src="<?= \Yii::$app->request->BaseUrl ?>/angularjs/lib/bootstrap.min.js"></script>
    <script src="<?= \Yii::$app->request->BaseUrl ?>/angularjs/lib/underscore.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?= \Yii::$app->request->BaseUrl ?>/angularjs/lib/ie10-viewport-bug-workaround.js"></script>
</head>
<?php //$this->beginBody() ?>


    <?= $content ?>

    <?php //$this->endBody() ?>
</html>
<?php $this->endPage() ?>
