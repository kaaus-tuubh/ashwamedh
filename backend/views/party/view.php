<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\PartyEmployee;
/* @var $this yii\web\View */
/* @var $model backend\models\Party */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Parties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mb30 mt-25">
  <section class="content-header">
    <ol class="breadcrumb">
      <li><?= Html::a('<i class="fa fa-users"></i> <span>Party Management</span>', ['/party/index'], ['class'=>''])?></li>
      <li class="active"><?= Html::encode($this->title) ?></li>
    </ol>
  </section>
</div>
<div class="party-view">
    <div class="row">
      <div class="col-md-12 col-lg-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="m0"><?= Html::encode($this->title) ?></h3>
            <div class="box-tools pull-right">
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
                 
            <!--<div class="row mb30">
              <div class="col-md-6 col-lg-6">
              </div>
              <div class="col-md-6 col-lg-6 right">
                <?= Html::a('<i class="fa fa-edit"></i> Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('<i class="fa fa-remove"></i> Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
              </div>  
            </div>  -->
            
            <div class="row">
              <div class="col-md-6 col-lg-6">
                  <?= DetailView::widget([
                                            'model' => $model,
                                            'attributes' => [
                                                'name',
                                                'email:email',
                                                'mobile',
                                            ],
                                            'options'=> ['class' => 'table table-bordered table-hover']
                                        ]) 
                  ?>
              </div>
              <div class="col-md-6 col-lg-6">  
                  <?= DetailView::widget([
                                            'model' => $model,
                                            'attributes' => [
                                                'landline',
                                                [
                                                  'attribute'=>'branch',
                                                  'value'=> $model->partyBranch->branch_name
                                                ],
                                                'address',
                                            ],
                                            'options'=> ['class' => 'table table-bordered table-hover']
                                        ]) 
                  ?>
              </div>
            </div>
            
            <div class="row">                                        
              <div class="col-md-12 col-lg-12">
                <h4>CCO / Branch Manager Details</h4> 
                <?php $empDetails  = PartyEmployee::find()->where(['party_id' => $model->id])->all(); ?>
                <?php $i = 0; ?>                 
                <?php foreach ($empDetails as $emp): ?>
                   <?php $i++; ?>
                   <?php if($i%2 != 0 ):?>
                      <!--<div class="col-md-12 col-lg-12">  -->
                        <?php if($i%2 != 0 ):?>         
                            <div class="col-md-6 col-lg-6">
                                <?=  DetailView::widget([
                                        'model' => $emp,
                                        'attributes' => [
                                            'name',
                                            'email',
                                            'mobile',
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
                                        'model' => $emp,
                                        'attributes' => [
                                            'name',
                                            'email',
                                            'mobile',
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
            
            <!--<div class="row">                                        
              <div class="col-md-6 col-lg-6">
                <h4>CCO / Branch Manager Details</h4> 
                <?php $empDetails  = PartyEmployee::find()->where(['party_id' => $model->id])->all(); ?>                 
                <?php foreach ($empDetails as $emp): ?>
                
                       <?=  DetailView::widget([
                            'model' => $emp,
                            'attributes' => [
                                'name',
                                'email',
                                'mobile',
                            ],
                            'options'=> ['class' => 'table table-bordered table-hover']
                          ]) 
                      ?>
                      
                <?php endforeach; ?>
              </div>
            </div>-->
            
          </div>
        </div>            
      </div>
    </div>
</div>
