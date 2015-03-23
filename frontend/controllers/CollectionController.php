<?php

// exp: http://localhost:8081/signsmart_yii2_angularjs/frontend/web/collections/2
namespace frontend\controllers;

use yii\rest\ActiveController;

use Yii;
use yii\data\ActiveDataProvider;
use frontend\models\Collection;
use yii\web\Response;

class CollectionController extends ActiveController
{
    public $modelClass = 'frontend\models\Collection';

    public function actionSearch()
    {
        return new ActiveDataProvider([
            'query' => Collection::find(),
        ]);
    }

    public function actionAbc2()
    {
        $a = Collection::findOne(2);

        //Yii::$app->getResponse()->format = Response::FORMAT_JSON;
        return array('a' => $a, 'b' => 2);
    }


}
