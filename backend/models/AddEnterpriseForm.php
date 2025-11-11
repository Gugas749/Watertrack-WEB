<?php

namespace backend\models;

use common\models\Enterprise;
use Yii;
use yii\base\Model;

/**
 * Formulário para adicionar uma nova Enterprise
 */
class AddEnterpriseForm extends Model
{
    public $name;
    public $address;
    public $contactnumber;
    public $contactemail;
    public $website;

    public function rules()
    {
        return [
            [['name', 'address', 'contactnumber', 'contactemail', 'website'], 'trim'],
            ['name', 'required'],
            ['name', 'string', 'min' => 2, 'max' => 255],
            ['contactnumber', 'required'],
            ['contactnumber', 'string', 'max' => 50],
            ['contactemail', 'required'],
            ['contactemail', 'email'],
            ['contactemail', 'string', 'max' => 255],
            ['contactemail', 'unique', 'targetClass' => '\common\models\Enterprise', 'message' => 'Este email já está registado.'],
            ['website', 'url'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Nome',
            'contactnumber' => 'Numero de Contato',
            'contactemail' => 'Email de Contato',
            'website' => 'Website',
        ];
    }

    /**
     * Cria uma nova Enterprise
     * @return bool
     */
    public function createEnterprise()
    {
        if (!$this->validate()) {
            return false;
        }

        $enterprise = new Enterprise();
        $enterprise->name = $this->name;
        $enterprise->address = $this->address;
        $enterprise->contactNumber = $this->contactnumber;
        $enterprise->contactEmail = $this->contactemail;
        $enterprise->website = $this->website;

        return $enterprise->save();
    }
}
