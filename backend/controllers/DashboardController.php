<?php

namespace backend\controllers;

use common\models\LoginForm;
use common\models\Meter;
use common\models\MeterReading;
use common\models\User;
use Yii;
use yii\httpclient\Client;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

class DashboardController extends Controller
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
                    throw new \yii\web\ForbiddenHttpException('You are not allowed to access this page.');
                },
            ],
        ];
    }
    public function actionIndex()
    {
        $activeMeterCount = $this->getActiveMeterCount();
        $readingCount = $this->getReadingCount();
        $userCount = $this->getUserCount();
        return $this->render('index', [
            'activeMeterCount' => $activeMeterCount,
            'readingCount' => $readingCount,
            'userCount' => $userCount,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function getActiveMeterCount()
    {
        $meters=Meter::find()->all();
        $meterCount = 0;
        foreach ($meters as $meter) {
            if($meter->state==1){
                $meterCount++;
            }
        }
        return $meterCount;
    }

    public function getReadingCount()
    {
        $readings=MeterReading::find()->all();
        return count($readings);
    }

    public function getUserCount()
    {
        $users=User::find()->all();
        return count($users);
    }
}
