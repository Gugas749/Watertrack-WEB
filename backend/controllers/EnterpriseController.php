<?php

namespace backend\controllers;

use backend\models\AddEnterpriseForm;
use common\models\Enterprise;
use Yii;
use yii\web\Controller;

class EnterpriseController extends Controller
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
        $enterpriseIdParam = Yii::$app->request->get('id');

        $enterprises = Enterprise::find()->all();

        if (!empty($queryParam)) {
            $enterprises = array_filter($enterprises, function ($enterprise) use ($queryParam) {
                return stripos($enterprise->name, $queryParam) !== false;
            });
        }

        $detailEnterprise = null;
        if ($enterpriseIdParam !== null) {
            $detailEnterprise = Enterprise::find()->where(['id' => $enterpriseIdParam])->one();
        }

        return $this->render('index', [
            'enterprises' => $enterprises,
            'addEnterpriseModel' => new AddEnterpriseForm(),
            'detailEnterprise' => $detailEnterprise,
        ]);
    }

    public function actionCreate()
    {
        $model = new AddEnterpriseForm();

        if ($model->load(Yii::$app->request->post()) && $model->createEnterprise()) {
            Yii::$app->session->setFlash('success', 'Empresa criada com sucesso!');
            return $this->redirect(['index']);
        } else {
            Yii::error('CreateEnterprise failed: ' . json_encode($model->getErrors()), __METHOD__);
            Yii::$app->session->setFlash('error', 'Ação Falhada: Contactar Administrador [E-1]');
        }

        $enterprises = Enterprise::find()->all();
        return $this->render('index', [
            'addEnterpriseModel' => $model,
            'enterprises' => $enterprises,
        ]);
    }
}