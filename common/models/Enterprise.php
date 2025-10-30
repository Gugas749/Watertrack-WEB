<?php

namespace common\models;

use app\models\Meter;

/**
 * This is the model class for table "enterprise".
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string|null $contactNumber
 * @property string|null $contactEmail
 * @property string|null $website
 *
 * @property Meter[] $meter
 * @property Technicianinfo[] $technicianinfos
 */
class Enterprise extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'enterprise';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['contactNumber', 'contactEmail', 'website'], 'default', 'value' => null],
            [['name', 'address'], 'required'],
            [['name', 'address', 'contactNumber', 'contactEmail', 'website'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'address' => 'Address',
            'contactNumber' => 'Contact Number',
            'contactEmail' => 'Contact Email',
            'website' => 'Website',
        ];
    }

    /**
     * Gets query for [[Meters]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMeters()
    {
        return $this->hasMany(Meter::class, ['enterpriseID' => 'id']);
    }

    /**
     * Gets query for [[Technicianinfos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTechnicianinfos()
    {
        return $this->hasMany(Technicianinfo::class, ['enterpriseID' => 'id']);
    }

}
