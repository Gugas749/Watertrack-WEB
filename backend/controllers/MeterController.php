<?php

namespace backend\controllers;

use common\models\Meter;
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
        $meters = $this->getMeters();
        return $this->render('@contentsViews/meter/index', [
            'meters' => $meters,
        ]);
    }

    public function getMeters()
    {
        return Meter::find()
            ->all();
    }
}
