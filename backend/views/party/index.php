<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\PartyBranch;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\PartySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Parties';
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
<div class="party-index">    
    <div class="row">
      <div class="col-md-12 col-lg-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="m0"><?= Html::encode($this->title) ?></h3>
            <div class="box-tools pull-right">
              <?= Html::a('<i class="fa fa-pencil"></i> Create', ['create'], ['class' => 'btn btn-success']) ?>              
            </div>
          </div>
          <div class="box-body box-profile">  
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>                    
            <?= 
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
            
                        //'id',
                        'name',
                        'email:email',
                        'mobile',
                        //'landline',
                          [
                            'attribute'=>'branch',
                            'filter'=> PartyBranch::get_branches(), 
                            'value'=>'partyBranch.branch_name'
                          ],
                        // 'address',
            
                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                    'tableOptions'=> ['class' => 'table table-hover table-bordered']
                ]); 
            ?>
          </div>
        </div>            
      </div>
    </div>
</div>

