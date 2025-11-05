<?php

namespace backend\models;

use common\models\User;
use common\models\UserProfile;
use Yii;
use yii\base\Model;

class AddmeterForm extends Model
{
    //METER MODEL
    public $address;
    public $userID;
    public $meterTypeID;
    public $enterpriseID;
    public $class;
    public $instalationDate;
    public $maxCapacity;
    public $measureUnity;
    public $supportedTemperature;
    public $state;

    public function rules()
    {
        return [
            ['address', 'trim'],
            ['address', 'required'],
            ['address', 'string', 'min' => 2, 'max' => 255],

            ['userID', 'trim'],
            ['userID', 'required'],

            ['meterTypeID', 'trim'],
            ['meterTypeID', 'required'],

            ['enterpriseID', 'trim'],
            ['enterpriseID', 'required'],

            ['class', 'trim'],
            ['class', 'required'],
            ['class', 'string', 'min' => 1, 'max' => 2],
        ];
    }

    public function createmeter()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();

        if ($user->save()) {
            $userProfile = new UserProfile();
            $userProfile->userID = $user->id;
            $userProfile->birthDate = '2000-01-01';
            $userProfile->address = 'N/A';
            $userProfile->save(false); // skip validation

            return true;
        }

        return false;
    }
}
