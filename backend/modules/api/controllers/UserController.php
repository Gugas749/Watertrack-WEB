<?php

namespace backend\modules\api\controllers;

use yii\rest\ActiveController;

class UserController extends ActiveController
{
    public $modelClass = 'common\models\User'; // CRUD

    public function actionCount()
    {
        $usersmodel = new $this->modelClass;
        $recs = $usersmodel::find()->all();
        return ['count' => count($recs)];
    }

    public function actionNomes()
    {
        $usersmodel = new $this->modelClass;
        $recs = $usersmodel::find()->select(['username'])->all();
        return $recs;
    }
}
