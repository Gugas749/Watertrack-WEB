<?php

namespace backend\models;

use common\models\Metertype;
use Yii;
use yii\base\Model;

/**
 * Formulário para adicionar um novo Metertype
 */
class Addmetertypeform extends Model
{
    public $description;

    public function rules()
    {
        return [
            ['description', 'trim'],
            ['description', 'required'],
            ['description', 'string', 'min' => 2, 'max' => 255],
            ['description', 'unique', 'targetClass' => '\common\models\Metertype', 'message' => 'Esta descrição já está registada.'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'description' => 'Descrição',
        ];
    }

    /**
     * Cria um novo Metertype
     * @return bool
     */
    public function createMeterType()
    {
        if (!$this->validate()) {
            return false;
        }

        $meterType = new Metertype();
        $meterType->description = $this->description;

        return $meterType->save();
    }
}
