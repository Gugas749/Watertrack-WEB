<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "logs_contadores".
 *
 * @property int $ID
 * @property int $ID_Contador
 * @property float|null $Leitura
 * @property float|null $Consumo_Acumulado
 * @property string $Data
 * @property float|null $Pressao_Agua
 * @property string|null $Descricao
 * @property int|null $FoiAvaria
 * @property int|null $ID_avaria
 */
class LogsContadores extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'logs_contadores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Leitura', 'Consumo_Acumulado', 'Pressao_Agua', 'Descricao', 'ID_avaria'], 'default', 'value' => null],
            [['FoiAvaria'], 'default', 'value' => 0],
            [['ID_Contador', 'Data'], 'required'],
            [['ID_Contador', 'FoiAvaria', 'ID_avaria'], 'integer'],
            [['Leitura', 'Consumo_Acumulado', 'Pressao_Agua'], 'number'],
            [['Data'], 'safe'],
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
            'Leitura' => 'Leitura',
            'Consumo_Acumulado' => 'Consumo Acumulado',
            'Data' => 'Data',
            'Pressao_Agua' => 'Pressao Agua',
            'Descricao' => 'Descricao',
            'FoiAvaria' => 'Foi Avaria',
            'ID_avaria' => 'Id Avaria',
        ];
    }

}
