<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Party;
use yii\helpers\ArrayHelper;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\select2\Select2;  
use kartik\date\DatePicker;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $model backend\models\Cases */
/* @var $form yii\widgets\ActiveForm */
/*$parties = Party::find()
                        ->select('')
                        ->all();
$query = new Query;
$query	->select(['pr.id as pid' , 'CONCAT(pr.name," => ",pb.branch_name) as pname '])  
        ->from('party pr')
        ->join(	'INNER JOIN','party_branch pb','pb.branch_name = pr.branch');              
$command = $query->createCommand();               
$pdata = $command->queryAll();      */
$pdata = Yii::$app->db->createCommand('SELECT p.`id` as pid, p.`name`, p.`branch`, pb.branch_name, CONCAT( p.`name`, " ", pb.`branch_name`) as pname FROM `party` p INNER JOIN party_branch pb ON pb.id = p.branch
')->queryAll();
//print_r($query);              
?>
    <div class="row">
          <div class="col-md-12 col-lg-12">
<div class="cases-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    
    <div class="row">
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
              <?= $form->field($model, 'party_role')->radioList([1 => 'Applicant', 2 => 'Respondent'],['onchange'=>'role();'])?>
              <?php
                   /*echo $form->field($ProductShipping, 'id_shipping')->radioList(
                        ['1'=>'Free', '2'=>'Pickup','3'=>'Country Wise','4'=>'API'],
                            ['item' => function($index, $label, $name, $checked, $value) {    
                             $return = '<label class="radio">';
                             $return .= '<input type="radio" name="' . $name . '" value="' . $value . '">';
                             $return .= '<label>' . ucwords($label) . '</label>';
                             $return .= '</label>';
                             return $return;
                           },
                             'onclick' => "alert('test')"
                         ]
                       )->label(false);  */
              
              ?>
          </div>
          <div class="col-sm-4">
              <?= $form->field($model, 'applicant')->textInput() ?>
          </div>
              
    </div>

    <div class="row">
          <div class="col-sm-4">          
              <?= $form->field($model, 'respondent')->textInput() ?>
          </div>
          <div class="col-sm-4">
              <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
          </div>          
          <div class="col-sm-4">  
              <?= $form->field($model, 'claim_amount')->textInput() ?>                   
          </div>              
    </div>
    <div class="row">
          <div class="col-sm-4">
              <?= $form->field($model, 'case_type')->textInput(['maxlength' => true]) ?>
          </div>
          <div class="col-sm-4">          
              <?= $form->field($model, 'case_no')->textInput() ?>
          </div>
          <div class="col-sm-4">                        
              <?= $form->field($model, 'date_of_filing')->widget(DatePicker::classname(), [    
                                                                    'pluginOptions' => [
                                                                		  'format' => 'yyyy-mm-dd',
                                                                		  'todayHighlight' => true
                                                                    ],
                                                                ]); 
              ?>
                       
          </div>              
    </div>
        
    <div class="row">
        
        <div class="panel-heading"><h4> Case History </h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 50, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $caseHistory[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'next_date',
                    'stage',                                        
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($caseHistory as $i => $case): ?>
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
                            if (! $case->isNewRecord) {     
                                echo Html::activeHiddenInput($case, "[{$i}]id");
                            }
                        ?>
                        
                        <div class="row">
                            <div class="col-sm-4">
                                <?= $form->field($case, "[{$i}]next_date")->widget(DatePicker::classname(), [    
                                                                    'pluginOptions' => [
                                                                		  'format' => 'yyyy-mm-dd',
                                                                		  'todayHighlight' => true
                                                                    ],
                                                                ]); ?>
                            </div>
                            <div class="col-sm-4">
                                <?php $stages = [1=>'Appearance', 2=>'Written Statement', 3=>'Order', 4=>'Claim Affaidavit', 5=>'Reply Affaidavit', 6=>'Argument', 7=>'Hearing on exibit'];?>
                                <?= $form->field($case, "[{$i}]stage")->widget(Select2::classname(), [
                                                                    'data' => $stages,//ArrayHelper::map($parties,'id','name'),
                                                                    'language' => 'en',
                                                                    'options' => ['placeholder' => 'Select Stage'],
                                                                    'pluginOptions' => [
                                                                        'allowClear' => true
                                                                    ],
                                                                ]); ?>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script> 
    function fillTitle(){
        //alert();
        var res = $('#cases-respondent').val();
        var apl = $('#cases-applicant').val();
        title = apl+" VS "+res;
        if( res != '' && apl != '' )
          $('#cases-title').val(title);
    }    
    $('#cases-respondent').change(function(){
       fillTitle();
    });
    $('#cases-applicant').change(function(){
       fillTitle();
    });       
 
    function role(){       
       var party = $('#cases-party_id option:selected').text();
       if( party == 'Select Party' ){
          alert('Select party name');
          $('input[name="Cases[party_role]"]').prop('checked', false);
       }   
       else{   
        var role = $("input[name='Cases[party_role]']:checked").val();
         if( role == 1 ){
            $('#cases-title').val('');
            $('#cases-respondent').val('');
            $('#cases-applicant').val(party);
         }       
         else{
            $('#cases-title').val('');
            $('#cases-applicant').val('');
            $('#cases-respondent').val(party);
         } 
         fillTitle();
       }  
    }     
    $(function () {
    $(".dynamicform_wrapper").on('afterInsert', function(e, item) {
        var datePickers = $(this).find('[data-krajee-kvdatepicker]');
        datePickers.each(function(index, el) {
            $(this).parent().removeData().kvDatepicker('remove');
            $(this).parent().kvDatepicker(eval($(this).attr('data-krajee-kvdatepicker')));
        });
    }); 
    });
</script>