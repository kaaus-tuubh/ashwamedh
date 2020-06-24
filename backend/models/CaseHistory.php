<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "case_history".
 *
 * @property integer $id
 * @property string $next_date
 * @property string $stage
 * @property integer $case_id
 *
 * @property Cases $case
 */
class CaseHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'case_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['next_date', 'stage'], 'required'],
            [['next_date'], 'safe'],
            [['case_id'], 'integer'],
            [['stage'], 'string', 'max' => 25],
            [['case_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cases::className(), 'targetAttribute' => ['case_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'next_date' => 'Next Date',
            'stage' => 'Stage',
            'case_id' => 'Case ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCase()
    {
        return $this->hasOne(Cases::className(), ['id' => 'case_id']);
    }
}
