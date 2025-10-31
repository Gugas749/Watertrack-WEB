<?php

namespace backend\controllers;

use Yii;
use common\models\LoginForm;
use yii\web\Controller;

class SiteController extends Controller
{
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

        return $this->render('@backend/views/site/login', ['model' => $model]);
    }

    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;

        if ($exception !== null) {
            if (Yii::$app->user->isGuest) {
                return $this->redirect(['site/login']);
            } else {
                return $this->redirect(['dashboard/index']);
            }
        }
    }

}
