<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\PartyBranch */

$this->title = $model->branch_name;
$this->params['breadcrumbs'][] = ['label' => 'Party Branches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    
<div class="mb30 mt-25">
  <section class="content-header">
    <ol class="breadcrumb">
      <li><?= Html::a('<i class="fa fa-globe"></i> <span>Party Branches</span>', ['/party-branch/index'], ['class'=>''])?></li>
      <li class="active"><?= Html::encode($this->title) ?></li>
    </ol>
  </section>
</div>
<div class="party-branch-view">
    <div class="row">
      <div class="col-md-6 col-lg-6">
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

              <?= DetailView::widget([
                  'model' => $model,
                  'attributes' => [
                      //'id',
                      'branch_name',
                      [
                          'attribute'=>'isactive',
                          'value'=> function ($data) {
                                        $id = $data['isactive']; 
                                        $arr = array("0"=>" ","1"=>"Yes","2"=>"No");
                                        return $arr[$id];
                                    },                 
                      ],
                  ],
              ]) ?>
            
          </div>
          
        </div>            
      </div>
    </div>
</div>
