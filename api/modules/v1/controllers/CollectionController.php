<?php

// exp: http://localhost:8081/signsmart_yii2_angularjs/api/web/v1/collections/2
namespace api\modules\v1\controllers;

use yii\rest\ActiveController;

use Yii;
use yii\data\ActiveDataProvider;
use api\modules\v1\models\Collection;
use yii\web\Response;

class CollectionController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\Collection';

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
