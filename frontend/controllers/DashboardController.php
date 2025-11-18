<?php
namespace frontend\controllers;

use yii\web\Controller;

class DashboardController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index'); // views/dashboard/index.php
    }
}
