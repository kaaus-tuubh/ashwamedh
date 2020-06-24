<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cases".
 *
 * @property integer $id
 * @property string $Title
 * @property string $case_type
 * @property integer $case_no
 * @property integer $applicant
 * @property integer $respondent
 * @property integer $claim_amount
 * @property string $date_of_filing
 *
 * @property CaseHistory[] $caseHistories
 */
class Cases extends \yii\db\ActiveRecord
{
    public $partyEmail, $CcoEmail, $subjectEmail, $bodyEmail;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cases';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'case_type', 'case_no', 'party_id', 'party_id', 'party_role', 'claim_amount', 'date_of_filing'], 'required'],
            [['party_role', 'party_id', 'claim_amount'], 'integer'],
            [['date_of_filing'], 'safe'],
            [['title', 'applicant', 'respondent'], 'string', 'max' => 150],
            [['case_type'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'case_type' => 'Case Type',
            'case_no' => 'Case Number',
            'applicant' => 'Applicant Name',
            'respondent' => 'Respondent Name',
            'claim_amount' => 'Claim Amount',
            'date_of_filing' => 'Date Of Filing',
            'party_id' => 'Party Name', 
            'party_role' => 'Party Role', 
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCaseHistories()
    {
        return $this->hasMany(CaseHistory::className(), ['case_id' => 'id']);
    }

    public function getPartyName()
    {
        return $this->hasOne(Party::className(), ['id' => 'party_id'])->select('name')->scalar();

    }
}
