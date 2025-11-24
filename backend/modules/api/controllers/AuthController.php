<?php

namespace backend\modules\api\controllers;

use common\models\User;
use Yii;
use yii\rest\Controller;

class AuthController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        unset($behaviors['authenticator']);
        return $behaviors;
    }
    public function verbs()
    {
        return [
            'login' => ['POST'],
        ];
    }
    public function actionLogin()
    {
        $body = Yii::$app->request->post();
        $username = $body['username'] ?? null;
        $password = $body['password'] ?? null;

        if (!$username || !$password) {
            return [
                "success" => false,
                "message" => "Username and password required"
            ];
        }

        // Find user by username or email
        $user = User::findOne(['username' => $username]);

        if (!$user) {
            return [
                "success" => false,
                "message" => "User not found"
            ];
        }

        // Validate password
        if (!Yii::$app->security->validatePassword($password, $user->password_hash)) {
            return [
                "success" => false,
                "message" => "Incorrect password"
            ];
        }

        return [
            "success" => true,
            "user" => [
                "id" => $user->id,
                "username" => $user->username,
                "email" => $user->email,
            ]
        ];
    }
    public function actionTeste()
    {
        return [
            'success' => true,
            'message' => 'AuthController is reachable!',
        ];
    }
}
