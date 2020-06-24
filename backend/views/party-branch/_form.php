<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\PartyBranch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
  <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
    <div class="party-branch-form">

      <?php $form = ActiveForm::begin(); ?>
  
      <?= $form->field($model, 'branch_name')->textInput(['maxlength' => true]) ?>
  
      <?php $arr = [1=>'Yes', 2=>'No'];?>    
      <?php if($model->isNewRecord)$model->isactive = 1;?>
      <?= $form->field($model, 'isactive')->widget(Select2::classname(), [
                                                          'data' => $arr,
                                                          'language' => 'en',
                                                          'options' => ['placeholder' => 'Select Option'],
                                                          'pluginOptions' => [
                                                              'allowClear' => true
                                                          ],
                                                      ]);
                                                      ?>
  
      <div class="form-group">
          <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
      </div>
  
      <?php ActiveForm::end(); ?>

    </div>
  </div>
</div>
