<?php

namespace backend\controllers;

use backend\models\AdduserForm;
use common\models\User;
use common\models\UserProfile;
use Yii;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

class UserController extends Controller
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
        $userIdParam = Yii::$app->request->get('userID');

        $users = User::find()->all();

        if (!empty($queryParam)) {
            $users = array_filter($users, function ($user) use ($queryParam) {
                return stripos($user->username, $queryParam) !== false;
            });
        }

        $detailUser = null;
        if ($userIdParam !== null) {
            $detailUser = User::find()->where(['id' => $userIdParam])->with('userprofile')->one();
        }

        return $this->render('index', [
            'users' => $users,
            'addUserModel' => new AdduserForm(),
            'detailUser' => $detailUser,
        ]);
    }

    public function actionCreateuser()
    {
        // RBAC - Ver permissao de criar user
        if (!Yii::$app->user->can('createUser')) {
            throw new ForbiddenHttpException('Não tem permissão para criar utilizadores.');
        }

        $model = new AdduserForm();

        if ($model->load(Yii::$app->request->post()) && $model->createuser()) {
            Yii::$app->session->setFlash('success', 'Utilizador criado com sucesso!');
            return $this->redirect(['index']);
        } else {
            Yii::error('CreateUser failed: ' . json_encode($model->getErrors()), __METHOD__);
            Yii::$app->session->setFlash('error', 'Ação Falhada: Contactar Administrador [U-1]');
        }

        // Se falhar a validaçao refaz a view outra vez
        $users = User::find()->all();
        return $this->render('index', [
            'addUserModel' => $model,
            'users' => $users,
        ]);
    }
}