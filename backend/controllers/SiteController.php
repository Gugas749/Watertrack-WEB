<?php

namespace backend\controllers;

use Yii;
use common\models\LoginForm;
use yii\web\Controller;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::class,
                'rules' => [
                    // Allow guests to access login and error
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                        'roles' => ['?'], // guests
                    ],
                    // Allow logged-in users to access everything else
                    [
                        'allow' => true,
                        'roles' => ['@'], // authenticated
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    throw new \yii\web\ForbiddenHttpException('You are not allowed to access this page.');
                },
            ],
        ];
    }


    public function actionLogin()
    {
        $this->layout = 'main-login';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['dashboard/index']);
        }

        $model->password = '';

        return $this->render('login', ['model' => $model]);
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                'view' => '@backend/views/site/error.php',
            ],
        ];
    }
}
