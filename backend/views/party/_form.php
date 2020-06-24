<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use backend\models\PartyBranch;

/* @var $this yii\web\View */
/* @var $model backend\models\Party */
/* @var $form yii\widgets\ActiveForm */
?>
    <div class="row">
      <div class="col-md-12 col-lg-12">
          <div class="party-form ">
                              
            <?php $form = ActiveForm::begin(['id' => 'dynamic-form','options' => ['class'=>'']]); ?>
            <div class="row">
                <div class="col-sm-4">
                      <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-4">
                      <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-4">
                      <?= $form->field($model, 'mobile')->textInput() ?>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-4">
                      <?= $form->field($model, 'landline')->textInput() ?>
                </div>
                <div class="col-sm-4">                           
                      <?php $branches = PartyBranch::find()->where(['isactive'=>'1'])->all();?>
                      <?= $form->field($model, 'branch')->widget(Select2::classname(), [
                                                                          'data' => ArrayHelper::map($branches,'id','branch_name'),
                                                                          'language' => 'en',
                                                                          'options' => ['placeholder' => 'Select Branch'],
                                                                          'pluginOptions' => [
                                                                              'allowClear' => true
                                                                          ],
                                                                      ]);
                                                                      ?>              
                </div>
                <div class="col-sm-4">
                      <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
                </div>          
            </div>
            
            <div class="row">
        
                <div class="panel-heading"><h4>CCO / Branch Manager Details </h4></div>
                <div class="panel-body">
                     <?php DynamicFormWidget::begin([
                        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                        'widgetBody' => '.container-items', // required: css class selector
                        'widgetItem' => '.item', // required: css class
                        'limit' => 4, // the maximum times, an element can be cloned (default 999)
                        'min' => 1, // 0 or 1 (default 1)
                        'insertButton' => '.add-item', // css class
                        'deleteButton' => '.remove-item', // css class
                        'model' => $empDetails[0],
                        'formId' => 'dynamic-form',
                        'formFields' => [
                            'name',
                            'email',
                            'mobile',                    
                        ],
                    ]); ?>
        
                    <div class="container-items"><!-- widgetContainer -->
                    <?php foreach ($empDetails as $i => $detail): ?>
                        <div class="item panel panel-default"><!-- widgetBody -->
                            <div class="panel-heading">
                                <h3 class="panel-title pull-left"> Add Details</h3>
                                <div class="pull-right">
                                    <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                    <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <?php
                                    // necessary for update action.
                                    if (! $detail->isNewRecord) {     
                                        echo Html::activeHiddenInput($detail, "[{$i}]id");
                                    }
                                ?>
                                
                                <div class="row">
                                    <div class="col-sm-4">
                                        <?= $form->field($detail, "[{$i}]name")->textInput(['maxlength' => true]) ?>
                                    </div>
                                    <div class="col-sm-4">
                                        <?= $form->field($detail, "[{$i}]email")->textInput(['maxlength' => true]) ?>
                                    </div>
                                    <div class="col-sm-4">
                                        <?= $form->field($detail, "[{$i}]mobile")->textInput(['maxlength' => true]) ?>
                                    </div>
                                </div><!-- .row -->
                                
                            </div>
                        </div>
                    <?php endforeach; ?>
                    </div>
                    <?php DynamicFormWidget::end(); ?>
                </div>
        
            </div>
        
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        
            <?php ActiveForm::end(); ?>

          </div>
        </div>
    </div>