<?php

namespace backend\controllers;

use backend\models\Addmeterform;
use common\models\Enterprise;
use common\models\Meter;
use common\models\Metertype;
use common\models\User;
use yii\helpers\Json;
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
        $search = Yii::$app->request->get('q');
        $searchQuery = \common\models\Meter::find();
        $meterIdParam = Yii::$app->request->get('id');

        $detailMeter = null;

        //limpar search
        if ($search !== null && trim($search) === '') {
            return $this->redirect(['index']);
        }

        //simple search
        if ($search) {
            $searchQuery->andWhere(['like', 'address', $search]);
        }
        $meters = $searchQuery->all();

        if ($meterIdParam !== null) {
            $detailMeter = Meter::findOne($meterIdParam);
        }

        return $this->render('index', [
            'meters' => $meters,
            'search' => $search,
            'addMeterModel' => new Addmeterform(),
            'detailMeter' => $detailMeter,
            'meterTypes' => Metertype::find()->all(),
            'enterprises' => Enterprise::find()->all(),
            'users' => User::find()->all(),
        ]);
    }

    public function actionCreate()
    {
        $model = new Addmeterform();

        if ($model->load(Yii::$app->request->post()) && $model->createmeter()) {
            Yii::$app->session->setFlash('success', 'Contador criado com sucesso!');
            return $this->redirect(['index']);
        } else {
            Yii::error('CreateMeter failed: ' . json_encode($model->getErrors()), __METHOD__);
            Yii::$app->session->setFlash('error', 'Ação Falhada: Contactar Administrador [M-1]');
        }

        $meters = Meter::find()->all();
        return $this->render('index', [
            'addMeterModel' => $model,
            'meters' => $meters,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = Meter::findOne($id);
        if (!$model) {
            Yii::$app->session->setFlash('error', 'Ação Negada: Contador não encontrado.');
            return $this->redirect(['index']);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Contador atualizada com sucesso!');
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionUpdateState($id)
    {
        if (Yii::$app->request->isPost) {
            $meter = Meter::findOne($id);
            $meter->state = Yii::$app->request->post('state');
            $meter->save(false);

            Yii::$app->session->setFlash('success', 'Contador atualizado com sucesso!');

            if (Yii::$app->request->isPjax) {
                return $this->renderAjax('index', [
                    'meters' => Meter::find()->all(),
                ]);
            }

            return $this->redirect(['index']);
        }
    }
}