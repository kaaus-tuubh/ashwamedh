<?php
use yii\db\Query;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
$this->title = 'Case Report';
$this->params['breadcrumbs'][] = ['label' => 'Case Report', 'url' => ['Branchwisereport']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mb30 mt-25">
  <section class="content-header">
    <ol class="breadcrumb">
      <li><?= Html::a('<i class="fa fa-bar-chart"></i> <span>Case Report</span>', ['/cases/Branchwisereport'], ['class'=>''])?></li>
      <li class="active"><?= Html::encode($this->title) ?></li>
    </ol>
  </section>
</div>
<div class="row">
  <div class="col-md-12 col-lg-12">
    <div class="box box-primary">
      <div class="box-header with-border"><h3 class="m0"><?= Html::encode($this->title) ?></h3></div>
      <div class="box-body box-profile">            
<?php
        if(isset($_GET['partyid'])){
                            //echo $a = Party::find(['id' => $value->a]);
            $partyid = $_GET['partyid'];
            $querydb = new Query;

            $query = "SELECT c.*, c.applicant as applicant, c.respondent as respondent, c.case_no as caseno, c.date_of_filing as dof, ch.next_date as nextdate, ch.stage as stage
            FROM `cases` c
            INNER JOIN `case_history` ch ON ch.case_id = c.`id`
            WHERE c.`party_id`=$partyid ";                         
            $command = Yii::$app->db->createCommand($query);               
            $pdata = $command->queryAll();
            $dataProvider1 = new ArrayDataProvider([
                'allModels' => $pdata,
            ]);
            
            
            echo GridView::widget([
                'dataProvider' => $dataProvider1,
                'columns' => [
                  //  ['class' => 'yii\grid\SerialColumn'],
                    'respondent',
                    [
                        'header' => 'Respondent',
                        'attribute' => 'respondent',
                    ],
                    'applicant',
                    [
                        'header' => 'Date Of Filing',
                        'attribute' => 'dof',
                    ],
                    [
                        'header' => 'Case Number',
                        'attribute' => 'caseno',
                    ],
                    [
                        'header' => 'Next Date',
                        'attribute' => 'nextdate',
                    ],                    
                    [                        
                        'attribute' => 'stage',
                        'value' => function($data){
                                     $stages = [1=>'Appearance', 2=>'Written Statement', 3=>'Order', 4=>'Claim Affaidavit', 5=>'Reply Affaidavit', 6=>'Argument', 7=>'Hearing on exibit'];
                                     $stageid = $data['stage'];
                                     $stage_name =  $stages[$stageid];
                                     return $stage_name; 
                                   },
                    ],                   
                ],
            ]);          

        }

?>        
      </div>
    </div>            
  </div>
</div>
