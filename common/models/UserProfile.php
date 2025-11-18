<?php

namespace common\models;

/**
 * This is the model class for table "userprofile".
 *
 * @property int $id
 * @property string $name
 * @property string $birthDate
 * @property string $address
 * @property int $userID
 *
 * @property User $user
 */
class UserProfile extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'userprofile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'birthDate', 'address', 'userID'], 'required'],
            [['birthDate'], 'safe'],
            [['userID'], 'integer'],
            [['address'], 'string', 'max' => 100],
            [['userID'], 'unique'],
            [['userID'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['userID' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'birthDate' => 'Birth Date',
            'address' => 'Address',
            'userID' => 'User ID',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'userID']);
    }

}
