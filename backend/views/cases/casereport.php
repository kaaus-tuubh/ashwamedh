<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Case Report';

use backend\models\Party;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;  
use yii\db\Query;


$pdata = Yii::$app->db->createCommand('SELECT p.`id` as pid, p.`name`, p.`branch`, pb.branch_name, CONCAT( p.`name`, " => ", pb.`branch_name`) as pname FROM `party` p INNER JOIN party_branch pb ON pb.id = p.branch
')->queryAll(); 
?>

 
<div class="mb30 mt-25">
  <section class="content-header">
    <ol class="breadcrumb">
      <li><?= Html::a('<i class="fa fa-bar-chart"></i> <span>Case Report</span>', ['/cases/branchwisereport'], ['class'=>''])?></li>
      <li class="active"><?= Html::encode($this->title) ?></li>
    </ol>
  </section>
</div>
<div class="case-report-form"> 
    <div class="row">
      <div class="col-md-12 col-lg-12">
        <div class="box box-primary">
          <div class="box-header with-border"><h3 class="m0"><?= Html::encode($this->title) ?></h3></div>
          <div class="box-body box-profile">            
            <div class="row">
                
                    <div class="cases-report">

                        <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    
                        <div class="row">
                            <div class="col-sm-4">
                            </div>
                            <div class="col-sm-4">
                             
                                <?= $form->field($model, 'party_id')->widget(Select2::classname(), [
                                                                                    'data' => ArrayHelper::map($pdata,'pid','pname'), 
                                                                                    'language' => 'en',
                                                                                    'options' => ['placeholder' => 'Select Party'],
                                                                                    'pluginOptions' => [
                                                                                        'allowClear' => true
                                                                                    ],
                                                                                ]);   
                                ?>                                   
                            </div>
                            <div class="col-sm-4">
                            </div>   

                    
                        </div>  
                        <div class="row">
                            <div class="col-sm-4">
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <?= Html::submitButton('Generate Report', ['class' =>  'btn btn-primary']) ?>
                                </div>                                 
                            </div>
                            <div class="col-sm-4">
                               
                            </div>   

                    
                        </div>                          
                        <?php ActiveForm::end(); ?> 
                       
                    </div>  
                
            </div>  
            
          </div>
        </div>            
      </div>
    </div>
</div>