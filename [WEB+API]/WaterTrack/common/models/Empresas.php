<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "empresas".
 *
 * @property int $ID
 * @property string $Nome
 * @property string|null $Morada
 * @property string|null $ContactoNumero
 * @property string|null $ContactoEmail
 * @property string|null $Website
 */
class Empresas extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'empresas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Morada', 'ContactoNumero', 'ContactoEmail', 'Website'], 'default', 'value' => null],
            [['Nome'], 'required'],
            [['Nome', 'Website'], 'string', 'max' => 150],
            [['Morada'], 'string', 'max' => 255],
            [['ContactoNumero'], 'string', 'max' => 20],
            [['ContactoEmail'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Nome' => 'Nome',
            'Morada' => 'Morada',
            'ContactoNumero' => 'Contacto Numero',
            'ContactoEmail' => 'Contacto Email',
            'Website' => 'Website',
        ];
    }

}
