<?php
namespace frontend\controllers;

use yii\web\Controller;

class ReadingController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index'); // views/reading/index.php
    }
}
