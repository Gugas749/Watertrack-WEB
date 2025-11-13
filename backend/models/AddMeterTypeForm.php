<?php

namespace backend\models;

use common\models\MeterType;
use Yii;
use yii\base\Model;

/**
 * Formulário para adicionar um novo MeterType
 */
class AddMeterTypeForm extends Model
{
    public $description;

    public function rules()
    {
        return [
            ['description', 'trim'],
            ['description', 'required'],
            ['description', 'string', 'min' => 2, 'max' => 255],
            ['description', 'unique', 'targetClass' => '\common\models\MeterType', 'message' => 'Esta descrição já está registada.'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'description' => 'Descrição',
        ];
    }

    /**
     * Cria um novo MeterType
     * @return bool
     */
    public function createMeterType()
    {
        if (!$this->validate()) {
            return false;
        }

        $meterType = new MeterType();
        $meterType->description = $this->description;

        return $meterType->save();
    }
}
