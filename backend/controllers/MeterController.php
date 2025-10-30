<?php

namespace backend\controllers;

use yii\web\Controller;

class MeterController extends Controller
{
    public function actionIndex()
    {
        return $this->render('@backend/views/layouts/contents/meter/index');
    }

}
