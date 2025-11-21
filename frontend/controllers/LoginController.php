<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use common\models\Loginform;

class LoginController extends Controller
{
    // Usar layout próprio para login (sem sidebar)
    public $layout = 'auth';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'logout'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['?'], // visitantes
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'], // utilizadores logados
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        // Se já está autenticado → vai para o dashboard
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['/dashboard/index']);
        }

        $model = new Loginform();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['/dashboard/index']);
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(['/login/index']);
    }
}
