<?php

namespace frontend\controllers;
use yii\rest\ActiveController;

use Yii;
use yii\data\ActiveDataProvider;
use api\modules\v1\models\Products;
use yii\web\Response;


class ProductsController extends ActiveController
{
    public $modelClass = 'frontend\models\Products';

    public function actionSearch()
    {
        $a = Products::find()->asArray()->all();

        //Yii::$app->getResponse()->format = Response::FORMAT_JSON;
        return array(
            'status' => 'success', 'message' => 'Data selected from database',
            'data' => $a
        );
    }

}
