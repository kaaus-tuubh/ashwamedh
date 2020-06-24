<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\CaseHistory;

?>

<?php
$caseid = $_GET['id'];

?>
<?php $casename = $_POST['Cases']['title'];?> 
<?php $caseno   = $_POST['Cases']['case_no']; ?> 
            <div class="row">                                        
              <div class="col-md-12 col-lg-12">   
              <h5><?php echo $casename." [ ".$caseno." ]";?></h5>
              <?php $caseDetailsc = count($_POST['CaseHistory'])-1; ?>
              <?php echo $casedate = $_POST['CaseHistory'][$caseDetailsc]['next_date']; ?>
              <?php  $casestage = $_POST['CaseHistory'][$caseDetailsc]['stage']; ?>
              <?php $stages = [0=>' ',1=>'Appearance', 2=>'Written Statement', 3=>'Order', 4=>'Claim Affaidavit', 5=>'Reply Affaidavit', 6=>'Argument', 7=>'Hearing on exibit'];?>
              
              <?php echo $casestage = $stages[$casestage];?>
              
                <?php $caseDetails  = CaseHistory::find()->where(['case_id' => $caseid])->all(); ?>   
                <?php $i = 0; ?>                 
                <?php foreach ($caseDetails as $case): ?>
                   <?php $i++; ?>
                   <?php if($i == count($caseDetails)-1 ):?>

                                <?=  DetailView::widget([
                                      'model' => $case,
                                      'attributes' => [
                                          'next_date',
                                          [
                                              'attribute'=>'stage',
                                            'value'=> function ($data) {
                                                            $id = $data['stage']; 
                                                            $stages = [0=>' ',1=>'Appearance', 2=>'Written Statement', 3=>'Order', 4=>'Claim Affaidavit', 5=>'Reply Affaidavit', 6=>'Argument', 7=>'Hearing on exibit'];
                                                            return $stages[$id];
                                                        },                 
                                          ],                                
                                      ],
                                      'options'=> ['class' => 'table table-bordered table-hover']
                                    ]) 
                                ?>                            

                         
                   <?php endif;?>
                      
                <?php endforeach; ?>
              </div>
            </div>                
           