<?php

namespace backend\controllers;

use common\models\User;
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
        $users = $this->getUsers();
        return $this->render('@contentsViews/user/index', [
            'users' => $users,
        ]);
    }

    public function getUsers()
    {
        return User::find()
            ->with('profile')
            ->all();
    }

}
