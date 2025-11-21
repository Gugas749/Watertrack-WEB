<?php

namespace backend\models;

use common\models\Meter;
use common\models\User;
use common\models\Userprofile;
use Yii;
use yii\base\Model;

class Addmeterform extends Model
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
            // Address
            ['address', 'trim'],
            ['address', 'required'],
            ['address', 'string', 'min' => 2, 'max' => 255],

            // Foreign keys
            [['userID', 'meterTypeID', 'enterpriseID', 'state'], 'required'],
            [['userID', 'meterTypeID', 'enterpriseID', 'state'], 'integer'],

            // Class
            ['class', 'trim'],
            ['class', 'required'],
            ['class', 'string', 'max' => 10],

            // Instalation Date
            ['instalationDate', 'required'],
            ['instalationDate', 'date', 'format' => 'php:Y-m-d'],

            // Max Capacity
            ['maxCapacity', 'required'],
            ['maxCapacity', 'number'],

            // Measure Unity
            ['measureUnity', 'required'],
            ['measureUnity', 'string', 'max' => 10],

            // Supported Temperature
            ['supportedTemperature', 'required'],
            ['supportedTemperature', 'number'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'address' => 'Morada',
            'userID' => 'Utilizador',
            'meterTypeID' => 'Tipo de Contador',
            'enterpriseID' => 'Empresa',
            'class' => 'Classe',
            'instalationDate' => 'Data de Instalação',
            'maxCapacity' => 'Capacidade Máxima (L)',
            'measureUnity' => 'Unidade de Medida',
            'supportedTemperature' => 'Temperatura Suportada (ºC)',
            'state' => 'Estado',
        ];
    }

    public function createMeter()
    {
        if (!$this->validate()) {
            Yii::error('Validation failed for Addmeterform: ' . json_encode($this->errors), __METHOD__);
            return null;
        }

        $meter = new Meter();
        $meter->address = $this->address;
        $meter->userID = $this->userID;
        $meter->meterTypeID = $this->meterTypeID;
        $meter->enterpriseID = $this->enterpriseID;
        $meter->class = $this->class;
        $meter->instalationDate = $this->instalationDate;
        $meter->maxCapacity = $this->maxCapacity;
        $meter->measureUnity = $this->measureUnity;
        $meter->supportedTemperature = $this->supportedTemperature;
        $meter->state = $this->state;

        if (!$meter->save()) {
            Yii::error('Failed to save Meter: ' . json_encode($meter->errors), __METHOD__);
            return null;
        }

        Yii::info('Meter created successfully: ID ' . $meter->id, __METHOD__);
        return $meter;
    }
}
