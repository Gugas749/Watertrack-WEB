<?php

namespace backend\controllers;

use backend\models\AddmeterForm;
use backend\models\AdduserForm;
use common\models\Meter;
use Yii;
use yii\web\Controller;

class MeterController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    return Yii::$app->response->redirect(['site/login']);
                },
            ],
        ];
    }
    public function actionIndex()
    {
        $queryParam = Yii::$app->request->get('q');

        $meters = Meter::find()->all();

        if (!empty($queryParam)) {
            $meters = array_filter($meters, function ($meters) use ($queryParam) {
                return stripos($meters->address, $queryParam) !== false;
            });
        }

        return $this->render('@contentsViews/meter/index', [
            'meters' => $meters,
            'addMeterModel' => new AddmeterForm(),
        ]);
    }

    public function actionCreatemeter()
    {

    }


    public function getMeters()
    {
        return Meter::find()
            ->all();
    }
}
