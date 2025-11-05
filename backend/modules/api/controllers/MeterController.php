<?php

namespace backend\modules\api\controllers;

use yii\rest\ActiveController;

class MeterController extends ActiveController
{
    public $modelClass = 'common\models\Meter';

    public function actionFromuser($id)
    {
        $userprofilemodel = new $this->modelClass;
        $recs = $userprofilemodel::find()->where(['userID' => $id])->all();

        if (!$recs) {
            return ['error' => 'Meters not found'];
        }

        return $recs;
    }

    public function actionFromenterprise($id)
    {
        $userprofilemodel = new $this->modelClass;
        $recs = $userprofilemodel::find()->where(['enterpriseID' => $id])->all();

        if (!$recs) {
            return ['error' => 'Meters not found'];
        }

        return $recs;
    }

    public function actionType($id)
    {
        $userprofilemodel = new $this->modelClass;
        $recs = $userprofilemodel::find()->where(['meterTypeID' => $id])->all();

        if (!$recs) {
            return ['error' => 'Meters not found'];
        }

        return $recs;
    }

    public function actionWithstate($state)
    {
        $model = new $this->modelClass;
        $recs = $model::find()->where(['state' => $state])->all();

        if (!$recs) {
            return ['error' => 'Meters not found'];
        }

        return $recs;
    }
}
