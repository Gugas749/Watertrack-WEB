<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tipos_contadores".
 *
 * @property int $ID
 * @property string $Descricao
 */
class TiposContadores extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipos_contadores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Descricao'], 'required'],
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
            'Descricao' => 'Descricao',
        ];
    }

}
