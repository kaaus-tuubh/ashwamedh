<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CasesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cases';
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
<div class="cases-index">    
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
                        'title',
                        'case_type',
                        'case_no',
                        'applicant',
                        // 'respondent',
                        // 'claim_amount',
                        // 'date_of_filing',
            
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
