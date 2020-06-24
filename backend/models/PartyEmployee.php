<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "party_employee".
 *
 * @property integer $id
 * @property string $name
 * @property integer $email
 * @property integer $mobile
 * @property integer $party_id
 *
 * @property Party $party
 */
class PartyEmployee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'party_employee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'mobile'], 'required'],
            [['party_id'], 'integer'],
            [['email','name'], 'string', 'max' => 150],
            [['mobile'], 'string', 'max' => 10],
            [['party_id'], 'exist', 'skipOnError' => true, 'targetClass' => Party::className(), 'targetAttribute' => ['party_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'mobile' => 'Mobile',
            'party_id' => 'Party ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParty()
    {
        return $this->hasOne(Party::className(), ['id' => 'party_id']);
    }
}
