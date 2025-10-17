<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "contador".
 *
 * @property int $ID
 * @property string|null $Nome
 * @property string $Morada
 * @property int $ID_Morador
 * @property int $Id_Tipo
 * @property int $Id_Empresa
 * @property string|null $Classe
 * @property string|null $Data_Instalacao
 * @property float|null $Capacidade_Max
 * @property string|null $Unidade_Medida
 * @property float|null $Temperatura_Suportada
 * @property int $Estado
 */
class Contador extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contador';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Nome', 'Classe', 'Data_Instalacao', 'Capacidade_Max', 'Unidade_Medida', 'Temperatura_Suportada'], 'default', 'value' => null],
            [['Morada', 'ID_Morador', 'Id_Tipo', 'Id_Empresa', 'Estado'], 'required'],
            [['ID_Morador', 'Id_Tipo', 'Id_Empresa', 'Estado'], 'integer'],
            [['Data_Instalacao'], 'safe'],
            [['Capacidade_Max', 'Temperatura_Suportada'], 'number'],
            [['Nome'], 'string', 'max' => 150],
            [['Morada'], 'string', 'max' => 255],
            [['Classe'], 'string', 'max' => 10],
            [['Unidade_Medida'], 'string', 'max' => 20],
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
            'ID_Morador' => 'Id Morador',
            'Id_Tipo' => 'Id Tipo',
            'Id_Empresa' => 'Id Empresa',
            'Classe' => 'Classe',
            'Data_Instalacao' => 'Data Instalacao',
            'Capacidade_Max' => 'Capacidade Max',
            'Unidade_Medida' => 'Unidade Medida',
            'Temperatura_Suportada' => 'Temperatura Suportada',
            'Estado' => 'Estado',
        ];
    }

}
