<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "avarias_contadores".
 *
 * @property int $ID
 * @property int $ID_Contador
 * @property int|null $ID_Morador
 * @property string|null $Descricao
 */
class AvariasContador extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'avarias_contadores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID_Morador', 'Descricao'], 'default', 'value' => null],
            [['ID_Contador'], 'required'],
            [['ID_Contador', 'ID_Morador'], 'integer'],
            [['Descricao'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'ID_Contador' => 'Id Contador',
            'ID_Morador' => 'Id Morador',
            'Descricao' => 'Descricao',
        ];
    }

}
