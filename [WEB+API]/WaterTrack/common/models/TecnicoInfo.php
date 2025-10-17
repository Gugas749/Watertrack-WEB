<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tecnico_info".
 *
 * @property int $ID
 * @property int $Id_User
 * @property int|null $Id_Empresa
 * @property string|null $Num_Cedula_Profissional
 */
class TecnicoInfo extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tecnico_info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id_Empresa', 'Num_Cedula_Profissional'], 'default', 'value' => null],
            [['Id_User'], 'required'],
            [['Id_User', 'Id_Empresa'], 'integer'],
            [['Num_Cedula_Profissional'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Id_User' => 'Id User',
            'Id_Empresa' => 'Id Empresa',
            'Num_Cedula_Profissional' => 'Num Cedula Profissional',
        ];
    }

}
