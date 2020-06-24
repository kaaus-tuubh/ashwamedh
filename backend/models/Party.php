<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "party".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property integer $mobile
 * @property integer $landline
 * @property string $branch
 * @property string $address
 *
 * @property PartyEmployee[] $partyEmployees
 */
class Party extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'party';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'branch'], 'required'],
            [['landline','branch'], 'integer'],
            [['name'], 'string', 'max' => 150],
            [['mobile'], 'string', 'max' => 10],
            [['email'], 'string', 'max' => 50],            
            [['address'], 'string', 'max' => 500],   
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
            'landline' => 'Landline',
            'branch' => 'Branch',
            'address' => 'Address',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartyEmployees()
    {
        return $this->hasMany(PartyEmployee::className(), ['party_id' => 'id']);
    }           
    
    public function getPartyBranch()
    {
        return $this->hasOne(PartyBranch::className(),['id' => 'branch']);
    }
}
