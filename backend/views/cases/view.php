<?php


use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\CaseHistory;
use yii\bootstrap\Modal;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model backend\models\Cases */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Cases', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mb30 mt-25">
  <section class="content-header">
    <ol class="breadcrumb">
      <li><?= Html::a('<i class="fa fa-book"></i> <span>Case Management</span>', ['/cases/index'], ['class'=>''])?></li>
      <li class="active"><?= Html::encode($this->title) ?></li>
    </ol>
  </section>
</div>
<div class="cases-view">
    <div class="row">
      <div class="col-md-12 col-lg-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="m0"><?= Html::encode($this->title) ?></h3>
            <div class="box-tools pull-right">
              <?= Html::button('<i class="fa fa-envelope-o"></i> Send Mail',['value'=>Url::to('index.php?r=cases/composemail&id='.$model->id), 'class' => 'btn btn-success','id' => 'mail-compose-btn']) ?>                
              <?= Html::a('<i class="fa fa-edit"></i> Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
              <?= Html::a('<i class="fa fa-remove"></i> Delete', ['delete', 'id' => $model->id], [
                  'class' => 'btn btn-danger',
                  'data' => [
                      'confirm' => 'Are you sure you want to delete this item?',
                      'method' => 'post',
                  ],
              ]) ?>              
            </div>
          </div>
          <div class="box-body box-profile">                     
            
            <div class="row">
              <div class="col-md-6 col-lg-6">
                  <?= DetailView::widget([
                                            'model' => $model,
                                            'attributes' => [
                                                'title',
                                                'case_type',
                                                'case_no',
                                                'applicant',
                                            ],
                                            'options'=> ['class' => 'table table-bordered table-hover']
                                        ]) 
                  ?>
              </div>
              <div class="col-md-6 col-lg-6">  
                  <?= DetailView::widget([
                                            'model' => $model,
                                            'attributes' => [
                                              'respondent',
                                              'claim_amount',
                                              'date_of_filing',
                                            ],
                                            'options'=> ['class' => 'table table-bordered table-hover']
                                        ]) 
                  ?>
              </div>
            </div>
            
            <div class="row">                                        
              <div class="col-md-12 col-lg-12">
                <h4>Case History</h4> 
                <?php $caseDetails  = CaseHistory::find()->where(['case_id' => $model->id])->all(); ?>
                <?php $i = 0; ?>                 
                <?php foreach ($caseDetails as $case): ?>
                   <?php $i++; ?>
                   <?php if($i%2 != 0 ):?>
                      <!--<div class="col-md-12 col-lg-12">  -->
                        <?php if($i%2 != 0 ):?>         
                            <div class="col-md-6 col-lg-6">
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
                            
                            </div>                            
                        <?php endif;?>
                   <?php else:?>   
                        <?php if($i%2 == 0 ):?>         
                            <div class="col-md-6 col-lg-6"> 
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
                            </div>                             
                        <?php endif;?>                   
                      <!--</div>   -->                
                   <?php endif;?>
                      
                <?php endforeach; ?>
              </div>
            </div>
            
          </div>
        </div>            
      </div>
    </div>
</div>
    <?php
        Modal::begin([
            'header' => '<span>Compose Mail</span>',            
            'id' => 'mail-form',
        ]);
        echo '<div id="mailcontent"></div>';
        Modal::end();
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
    $("#mail-compose-btn").click(function(){               
       $("#mail-form").modal('show').find('#mailcontent').load($(this).attr('value'));
    });
    </script>