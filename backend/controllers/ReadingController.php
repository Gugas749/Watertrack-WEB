<?php

namespace backend\controllers;

use backend\models\Adduserform;
use common\models\Enterprise;
use common\models\Meter;
use common\models\Meterproblem;
use common\models\Meterreading;
use common\models\Technicianinfo;
use common\models\User;
use common\models\Userprofile;
use Yii;

class ReadingController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::class,
                'except' => ['error'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    return Yii::$app->response->redirect(['site/login']);                },
            ],
        ];
    }
    public function actionIndex()
    {
        $queryParam = Yii::$app->request->get('q');
        $readingIdParam = Yii::$app->request->get('id');

        $detailReading = null;
        $technician = null;
        $meter = null;
        $problem = null;

        $enterprises = Enterprise::find()->all();

        if ($queryParam !== null && trim($queryParam) === '') {
            return $this->redirect(['index']);
        }

        if ($readingIdParam !== null) {
            $detailReading = Meterreading::find()
                ->where(['id' => $readingIdParam])
                ->one();

            if ($detailReading) {
                $technician = User::find()->where(['id' => $detailReading->userID])->one();
                $meter = Meter::find()->where(['id' => $detailReading->meterID])->one();
                $problem = Meterproblem::find()->where(['id' => $detailReading->problemID])->one();
            }
        }

        return $this->render('index', [
            'users' => User::find()->all(),
            'enterpriseList' => $enterprises,
            'detailReading' => $detailReading,
            'technician' => $technician,
            'meter' => $meter,
            'problem' => $problem,
            'enterpriseItems' => \yii\helpers\ArrayHelper::map($enterprises, 'id', 'name'),
        ]);
    }

    public function actionGetMeters($enterpriseID)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $items = Meter::find()
            ->where(['enterpriseID' => $enterpriseID])
            ->all();

        return array_map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->address,
            ];
        }, $items);
    }
    public function actionGetReadings($meterID)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $readings = Meterreading::find()
            ->where(['meterID' => $meterID])
            ->orderBy(['date' => SORT_DESC])
            ->all();

        return array_map(function($r) {
            return [
                'id' => $r->id,
                'value' => $r->reading,
                'accumulatedConsumption' => $r->accumulatedConsumption,
                'waterPressure' => $r->waterPressure,
                'readingDate' => Yii::$app->formatter->asDate($r->date, 'php:d/m/Y'),
                'wasFix' => ($r->readingType == 1),
            ];
        }, $readings);
    }
    public function actionGetReadingDetail($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $detailReading = Meterreading::find()->where(['meterID' => $id])->one();

        return $this->render('index', [
            'detailReading' => $detailReading,
        ]);
    }
}