<?php

namespace backend\modules\api\controllers;

use yii\rest\ActiveController;

class UserProfileController extends ActiveController
{
    public $modelClass = 'common\models\UserProfile';

    public function actionProfile($id)
    {
        $userprofilemodel = new $this->modelClass;
        $recs = $userprofilemodel::find()->where(['userID' => $id])->one();

        if (!$recs) {
            return ['error' => 'Profile not found'];
        }

        return $recs;
    }
}
