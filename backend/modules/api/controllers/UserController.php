<?php

namespace backend\modules\api\controllers;

use yii\rest\ActiveController;

class UserController extends ActiveController
{
    public $modelClass = 'common\models\User'; // CRUD

    public function actionPutstatus($id)
    {
        $status=\Yii::$app->request->post('status');
        $climodel = new $this->modelClass;
        $ret = $climodel::findOne(['id' => $id]);
        if($ret)
        {
            $ret->status = $status;
            $ret->save();
        }
        else
        {
            throw new \yii\web\NotFoundHttpException("Nome de prato não existe");
        }
    }
}
