<?php

namespace backend\modules\api\controllers;

use yii\rest\ActiveController;

class MeterProblemController extends ActiveController
{
    public $modelClass = 'common\models\Meterproblem';

    public function actionFromuser($id)
    {
        $userprofilemodel = new $this->modelClass;
        $recs = $userprofilemodel::find()->where(['userID' => $id])->one();

        if (!$recs) {
            return ['error' => 'Problems not found'];
        }

        return $recs;
    }

    public function actionFrommeter($id)
    {
        $userprofilemodel = new $this->modelClass;
        $recs = $userprofilemodel::find()->where(['meterID' => $id])->one();

        if (!$recs) {
            return ['error' => 'Problems not found'];
        }

        return $recs;
    }
}
