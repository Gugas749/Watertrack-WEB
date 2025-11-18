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
    // backend/controllers/MeterController.php

    public function actionIndex()
    {
        $queryParam = Yii::$app->request->get('q');
        $meterIdParam = Yii::$app->request->get('id');
        $meters = Meter::find()->all();
        $detailMeter = null;

        //limpar os parametros da url
        if ($queryParam !== null && trim($queryParam) === '') {
            return $this->redirect(['index']);
        }

        //filtrar
        if (!empty($queryParam)) {
            $meters = array_filter($meters, function ($meter) use ($queryParam) {
                return stripos($meter->address, $queryParam) !== false;
            });
        }
        if ($meterIdParam !== null) {
            $detailMeter = Meter::findOne($meterIdParam);
        }

        return $this->render('index', [
            'meters' => $meters,
            'addMeterModel' => new AddMeterForm(),
            'detailMeter' => $detailMeter,
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