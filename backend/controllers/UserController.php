<?php

namespace backend\controllers;

use yii\web\Controller;

class UserController extends Controller
{
    public function actionIndex()
    {
        return $this->render('@backend/views/layouts/contents/user/index');
    }
}
