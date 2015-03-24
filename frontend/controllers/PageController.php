<?php

// exp: http://localhost:8081/signsmart_yii2_angularjs/frontend/web/collections/2
namespace frontend\controllers;

use yii\console\Controller;
use yii\rest\ActiveController;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Response;

use frontend\models\Collection;
use frontend\models\Subscription;

class PageController extends ActiveController
{
    public $modelClass = '';

    public function actionCustomorder(){

        $result = [
            'OK' => 1
        ];

        $id = Yii::$app->user->getId();
        if (!empty($id)) {

            $result['OK'] = 0;
        }

        $allSubscription = Subscription::find()->with('msGvs')->asArray()->all();

        $free = Subscription::find()->where(['id' => 1])->one();
        $gold = Subscription::find()->where(['id' => 2])->one();

//        $platinum = Subscription::find()->where(['id' => 3])->one();
//        $vip = Subscription::find()->where(['id' => 4])->one();

        //$now = gmdate("Y-m-1\TH:i:s\Z");
        //$nextChargeDate = new \DateTime($now);

        $nextChargeDate = new \DateTime('now', new \DateTimeZone('UTC'));
        $nextChargeDate->modify("+1 month"); //get same day of next month like paypal do
        $nextRecurringDate = $nextChargeDate->format('m/d/Y');

        return [
            'free' => $free,
            'gold' => $gold,
            'nextRecurringDate' => $nextRecurringDate,
            'allSubscription' => $allSubscription
        ];
    }

}
