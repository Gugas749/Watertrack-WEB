<?php

namespace backend\controllers;

use backend\models\AdduserForm;
use common\models\User;
use Yii;
use yii\web\Controller;

class UserController extends Controller
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
        $addUserModel = new AdduserForm();

        $users = $this->getUsers();
        return $this->render('@contentsViews/user/index', [
            'addUserModel' => $addUserModel,
            'users' => $users,
        ]);
    }

    public function actionCreateuser()
    {
        $model = new AdduserForm();

        if ($model->load(Yii::$app->request->post()) && $model->createuser()) {
            Yii::$app->session->setFlash('success', 'Utilizador criado com sucesso!');
            return $this->redirect(['index']);
        } else {
            Yii::error('CreateUser failed: ' . json_encode($model->getErrors()), __METHOD__);
            Yii::$app->session->setFlash('error', 'Erro ao criar utilizador.');
        }

        // Se falhar a validaçao refaz a view outra vez
        $users = $this->getUsers();
        return $this->render('@contentsViews/user/index', [
            'addUserModel' => $model,
            'users' => $users,
        ]);
    }

    public function getUsers()
    {
        return User::find()
            ->with('profile')
            ->with('technicianInfo')
            ->all();
    }
}
