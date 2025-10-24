<?php

namespace backend\modules\api\controllers;

use yii\rest\ActiveController;

class MeterReadingController extends ActiveController
{
    public $modelClass = 'common\models\MeterReading';
}
