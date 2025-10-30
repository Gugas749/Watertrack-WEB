<?php

namespace backend\controllers;

class ReadingController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('@backend/views/layouts/contents/reading/index');
    }

}
