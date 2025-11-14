<?php

namespace backend\controllers;

use backend\models\AddMeterTypeForm;
use common\models\MeterType;
use Yii;
use yii\web\Controller;

class ExtrasController extends Controller
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
        $queryIdParam = Yii::$app->request->get('id');

        $meterTypes = MeterType::find()->all();

        if (!empty($queryParam)) {
            $meterTypes = array_filter($meterTypes, function ($search) use ($queryParam) {
                return stripos($search->description, $queryParam) !== false;
            });
        }

        $detailMeterTypes = null;
        if ($queryIdParam !== null) {
            $detailMeterTypes = MeterType::findOne($queryIdParam);
        }

        return $this->render('index', [
            'meterTypes' => $meterTypes,
            'addMeterTypeModel' => new AddMeterTypeForm(),
            'detailMeterTypes' => $detailMeterTypes,
        ]);
    }

    public function actionCreate()
    {
        $model = new AddMeterTypeForm();

        if ($model->load(Yii::$app->request->post())) {

            if ($model->createMeterType()) {
                Yii::$app->session->setFlash('success', 'Tipo de contador criado com sucesso!');
                return $this->redirect(['index']);
            } else {
                // Log the validation errors for debugging
                Yii::error('Create failed: ' . json_encode($model->getErrors()), __METHOD__);
                // Do NOT set a generic flash — the form will display validation errors automatically
            }
        }

        // Always load the meter types for the index view
        $meterTypes = MeterType::find()->all();

        return $this->render('index', [
            'addMeterTypeModel' => $model,
            'meterTypes' => $meterTypes,
            'detailMeterTypes' => null,
        ]);
    }


    public function actionUpdate($id)
    {
        $model = MeterType::findOne($id);
        if (!$model) {
            Yii::$app->session->setFlash('error', 'Tipo de Contador não encontrado.');
            return $this->redirect(['index']);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Tipo de Contador atualizado com sucesso!');
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
}