<?php

namespace backend\modules\api\controllers;

use yii\rest\ActiveController;

class MeterController extends ActiveController
{
    public $modelClass = 'common\models\Meter';

    public function actionFromuser($id)
    {
        $userprofilemodel = new $this->modelClass;
        $recs = $userprofilemodel::find()->where(['userID' => $id])->one();

        if (!$recs) {
            return ['error' => 'Meters not found'];
        }

        return $recs;
    }

    public function actionFromenterprise($id)
    {
        $userprofilemodel = new $this->modelClass;
        $recs = $userprofilemodel::find()->where(['enterpriseID' => $id])->one();

        if (!$recs) {
            return ['error' => 'Meters not found'];
        }

        return $recs;
    }

    public function actionType($id)
    {
        $userprofilemodel = new $this->modelClass;
        $recs = $userprofilemodel::find()->where(['meterTypeID' => $id])->one();

        if (!$recs) {
            return ['error' => 'Meters not found'];
        }

        return $recs;
    }

    public function actionWithstate($id)
    {
        $userprofilemodel = new $this->modelClass;
        $recs = $userprofilemodel::find()->where(['state' => $id])->one();

        if (!$recs) {
            return ['error' => 'Meters not found'];
        }

        return $recs;
    }
}
