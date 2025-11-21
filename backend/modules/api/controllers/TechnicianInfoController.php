<?php

namespace backend\modules\api\controllers;

use yii\rest\ActiveController;

class TechnicianInfoController extends ActiveController
{
    public $modelClass = 'common\models\Technicianinfo';

    public function actionTechinfo($id)
    {
        $userprofilemodel = new $this->modelClass;
        $recs = $userprofilemodel::find()->where(['userID' => $id])->one();

        if (!$recs) {
            return ['error' => 'Profile not found'];
        }

        return $recs;
    }
}
