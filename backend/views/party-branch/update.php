<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PartyBranch */

$this->title = 'Update Party Branch: ' . $model->branch_name;
$this->params['breadcrumbs'][] = ['label' => 'Party Branches', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="mb30 mt-25">
  <section class="content-header">
    <ol class="breadcrumb">
      <li><?= Html::a('<i class="fa fa-globe"></i> <span>Party Branches</span>', ['/party-branch/index'], ['class'=>''])?></li>
      <li class="active"><?= Html::encode($this->title) ?></li>
    </ol>
  </section>
</div>

<div class="party-branch-update">    
    <div class="row">
      <div class="col-md-6 col-lg-6">
        <div class="box box-primary">
          <div class="box-header with-border"><h3 class="m0"><?= Html::encode($this->title) ?></h3></div>
          <div class="box-body box-profile">            
            
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
          </div>
        </div>            
      </div>
    </div>
</div>
