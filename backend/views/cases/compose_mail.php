<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;  
use yii\db\Query;
use yii\helpers\Url;
use backend\models\CaseHistory;

$id = $_GET['id'];
$query = new Query;
$query  = "SELECT c.title as title,c.case_no as caseno, c.`party_id` AS pid, GROUP_CONCAT( pe.email ) AS pempmail, pr.email AS premail
FROM `cases` c
INNER JOIN `party` pr ON pr.id = c.`party_id`
INNER JOIN `party_employee` pe ON pe.`party_id` = c.`party_id`
WHERE c.`id`=$id ";                         
$command = Yii::$app->db->createCommand($query);               
$pdata = $command->queryAll();
$branchmail = '';
$empmail    = '';
$body       = '';
if(!empty($pdata))
{
    $caseDetails  = CaseHistory::find()->where(['case_id' => $id])->all();
    $stages = [0=>' ',1=>'Appearance', 2=>'Written Statement', 3=>'Order', 4=>'Claim Affaidavit', 5=>'Reply Affaidavit', 6=>'Argument', 7=>'Hearing on exibit'];
    $i = 0; 
    
    $branchmail = $pdata[0]['premail'];
    $empmail = $pdata[0]['pempmail'];   
    //$empmail  = explode(',',$empmail);
    $model->partyEmail  = $branchmail; 
    $model->CcoEmail    = $empmail;          
    $model->subjectEmail    = 'Case Details';
    $model->title       = $pdata[0]['title']; 
    $model->case_no       = $pdata[0]['caseno']; 
    $body .= '<h5>'.$model->title.'</h5>';
    $body .= '<b>Case Number : </b>'.$model->case_no.'<br>';
    foreach ($caseDetails as $case):
      $i++;
      if($i == count($caseDetails) ):   
        $stg  = $case['stage'];         
        $body .= '<b>Next Date   : </b>'.$case['next_date'].'<br>';
        $body .= '<b>Stage       : </b>'.$stages[$stg].'<br>';                                                      
        
     endif;                      
    endforeach;    

    /*$body .= '<table><tbody>';
    $body .= '<tr><th>Case Number : </th><td>'.$model->case_no.'</td></tr><br>';
    $body .= '<tr><th>Next Date   : </th><td>'.$model->case_no.'</td></tr><br>';
    $body .= '<tr><th>Stage       : </th><td>'.$model->case_no.'</td></tr><br>';
    $body .= '</tbody></table><br>'; */
    
    $model->bodyEmail    = $body;    
    
}

?>

<div class="compose-mail">
          <div class="">
            <!--<div class="box-header with-border">
            </div>
             /.box-header -->
             
            <?php $form = ActiveForm::begin(['id' => '']); ?> 
            <div class="box-body">              
                <div class="form-group">
                  <?= $form->field($model, 'partyEmail')->textInput(['class' => 'form-control','placeholder' => 'To:','id' => ''])->label(false) ?>
                </div>
                <div class="form-group">
                  <?= $form->field($model, 'CcoEmail')->textInput(['class' => 'form-control','placeholder' => 'To:','id' => ''])->label(false) ?>
                </div>       
             
              <div class="form-group">
                <?= $form->field($model, 'subjectEmail')->textInput(['class' => 'form-control','placeholder' => 'Subject:','id' => ''])->label(false) ?>
              </div>   
              <div class="form-group">                    
                <?= $form->field($model, 'bodyEmail')->textArea(['class' => 'form-control','placeholder' => 'Body:','id' => 'compose-textarea','style' => 'height:300px','rows' => '6'])->label(false) ?>                                            
              </div>                                                                    
              <div class="pull-right">
                <!--<button type="button" class="btn btn-default"><i class="fa fa-pencil"></i> Draft</button>   -->
                <?= Html::submitButton('<i class="fa fa-envelope-o"></i> Send',[ 'class' => 'btn btn-primary']) ?>                
              </div> 
            </div>
            <!-- /.box-body -->
    
            <?php ActiveForm::end(); ?>
          </div>
          <!-- /. box -->

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
  $(function () {
    //bootstrap WYSIHTML5 - text editor
    $('#compose-textarea').wysihtml5()
  })
</script>