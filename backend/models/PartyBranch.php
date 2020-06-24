<?php

namespace backend\models;
use yii\helpers\ArrayHelper;
use Yii;     

/**
 * This is the model class for table "party_branch".
 *
 * @property integer $id
 * @property string $branch_name
 * @property integer $isactive
 */
class PartyBranch extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'party_branch';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['branch_name', 'isactive'], 'required'],
            [['isactive'], 'integer'],
            [['branch_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'branch_name' => 'Branch Name',
            'isactive' => 'Isactive',
        ];
    }
    
    public static function get_branches(){
        $branches = PartyBranch::find()->all();
        $branches = ArrayHelper::map($branches,'id','branch_name');
        return $branches;
    }    
}
