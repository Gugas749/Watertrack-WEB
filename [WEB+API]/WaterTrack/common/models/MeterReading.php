<?php

namespace common\models;

/**
 * This is the model class for table "meterreading".
 *
 * @property int $id
 * @property int $meterID
 * @property string $reading
 * @property string $accumulatedConsumption
 * @property string $date
 * @property string $waterPressure
 * @property string $desc
 * @property int $problemState
 *
 * @property Meter $meter
 */
class MeterReading extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'meterreading';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['meterID', 'reading', 'accumulatedConsumption', 'date', 'waterPressure', 'desc', 'problemState'], 'required'],
            [['meterID', 'problemState'], 'integer'],
            [['date'], 'safe'],
            [['reading', 'accumulatedConsumption', 'waterPressure', 'desc'], 'string', 'max' => 100],
            [['meterID'], 'exist', 'skipOnError' => true, 'targetClass' => Meter::class, 'targetAttribute' => ['meterID' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'meterID' => 'Meter ID',
            'reading' => 'Reading',
            'accumulatedConsumption' => 'Accumulated Consumption',
            'date' => 'Date',
            'waterPressure' => 'Water Pressure',
            'desc' => 'Desc',
            'problemState' => 'Problem State',
        ];
    }

    /**
     * Gets query for [[Meter]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMeter()
    {
        return $this->hasOne(Meter::class, ['id' => 'meterID']);
    }

}
