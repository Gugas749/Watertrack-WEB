<?php
namespace frontend\controllers;

use yii\web\Controller;

class ReportController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index'); // views/meter/index.php
    }
}
