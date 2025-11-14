<?php

namespace backend\controllers;

use backend\models\AddMeterForm;
use backend\models\AddUserForm;
use common\models\Enterprise;
use common\models\Meter;
use common\models\MeterType;
use common\models\User;
use Yii;
use yii\web\Controller;

class MeterController extends Controller
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

        return $this->render('index', [
            'meters' => $meters,
            'addMeterModel' => new AddMeterForm(),
            'meterTypes' => MeterType::find()->all(),
            'enterprises' => Enterprise::find()->all(),
            'users' => User::find()->all(),
        ]);
    }

    public function actionCreatemeter()
    {
        $model = new AddMeterForm();

        if ($model->load(Yii::$app->request->post()) && $model->createmeter()) {
            Yii::$app->session->setFlash('success', 'Contador criado com sucesso!');
            return $this->redirect(['index']);
        } else {
            Yii::error('CreateMeter failed: ' . json_encode($model->getErrors()), __METHOD__);
            Yii::$app->session->setFlash('error', 'Ação Falhada: Contactar Administrador [M-1]');
        }

        $meters = $this->getMeters();
        return $this->render('index', [
            'addMeterModel' => $model,
            'meters' => $meters,
        ]);
    }

    public function getMeters()
    {
        return Meter::find()
            ->all();
    }
}