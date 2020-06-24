<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Cases */

$this->title = 'Create Case';
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
<div class="cases-create">  
    <div class="row">
      <div class="col-md-12 col-lg-12">
        <div class="box box-primary">
          <div class="box-header with-border"><h3 class="m0"><?= Html::encode($this->title) ?></h3></div>
          <div class="box-body box-profile">            
            
            <?= $this->render('_form', [
                'model' => $model,
                'caseHistory'=> $caseHistory
            ]) ?>
            
          </div>
        </div>            
      </div>
    </div>
</div>

