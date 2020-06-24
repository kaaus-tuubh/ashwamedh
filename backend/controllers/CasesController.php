<?php

namespace backend\controllers;

use Yii;
use backend\models\Cases;
use backend\models\CasesSearch;
use backend\models\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use backend\models\CaseHistory;
use yii\swiftmailer\Mailer;

/**
 * CasesController implements the CRUD actions for Cases model.
 */
class CasesController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
            'class' => \yii\filters\AccessControl::className(),
            'only' => ['index','create','update','view','branchwisereport','mailbox','generatereport','composemail'],
            'rules' => [
                // allow authenticated users
                      [
                    'allow' => true,
                    'roles' => ['@'],
                      ],
                // everything else is denied
                      ],
          ],
        ];
    }

    /**
     * Lists all Cases models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CasesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cases model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Cases model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cases();
        $caseHistory = [new CaseHistory];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $caseHistory = Model::createMultiple(CaseHistory::classname());
            Model::loadMultiple($caseHistory, Yii::$app->request->post());
            
            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($caseHistory) && $valid;
            
            if ($valid) {                 
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($caseHistory as $case) {
                            $case->case_id = $model->id;
                            if (! ($flag = $case->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }                      
        } else {
            return $this->render('create', [
                'model' => $model,
                'caseHistory' => (empty($caseHistory)) ? [new CaseHistory] : $caseHistory
            ]);
        }
    }

    /**
     * Updates an existing Cases model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $caseHistory = $model->caseHistories;
         
        if ($model->load(Yii::$app->request->post())) {
            $oldIDs = ArrayHelper::map($caseHistory, 'id', 'id'); 
            $caseHistory = Model::createMultiple(CaseHistory::classname(), $caseHistory);
            Model::loadMultiple($caseHistory, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($caseHistory, 'id', 'id')));

            // ajax validation
            /*if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsAddress),
                    ActiveForm::validate($modelCustomer)
                );
            } */

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($caseHistory) && $valid;

            if ($valid) {                 
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (! empty($deletedIDs)) {
                            PartyEmployee::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($caseHistory as $case) {
                            $case->case_id = $model->id;
                            if (! ($flag = $case->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        //print_r($_POST['Cases']);die;
                       /* if(isset($_POST['CaseHistory'])){
                            $message = "";
                            for($i=0;$i<count($_POST['CaseHistory']);$i++){
                              $stage = $_POST['CaseHistory'][$i]['stage'];  
                              $ndate = $_POST['CaseHistory'][$i]['next_date'];
                              $message .=  " Date : ".$stage." Stage  : ".$stage."<br>";
                            }

                            $value = Yii::$app->mailer->compose('casemail_view')
                                  ->setFrom("renukakul93@gmail.com","Advocate SPT")
                                  ->setTo("renukakul93@gmail.com")
                                  ->setSubject("Case Details")
                                  //->setHtmlBody($message)
                                  ->send(); 
                                  
                        }*/     
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            } 
        } else {
            return $this->render('update', [
                'model' => $model,
                'caseHistory' => (empty($caseHistory)) ? [new CaseHistory] : $caseHistory
            ]);
        }
    }

    /**
     * Deletes an existing Cases model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionBranchwisereport()
    {
        $model = new Cases();
        if(isset($_POST['Cases']))
        {
            if(!empty($_POST['Cases']))
            {
                $pid = $_POST['Cases']['party_id'];
				$this->redirect(array('generatereport','partyid'=>$pid));            
            }
        }
        return $this->render('casereport',[
                'model'=> $model,
            ]);               
    }
    public function actionGeneratereport($partyid)
    {
        return $this->render('report_view',[
                'partyid'=> $partyid,
            ]);         
    }
    /**
     * Finds the Cases model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cases the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cases::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionMailbox()
    {
        $searchModel = new CasesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('mailbox', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }  
    public function actionComposemail($id)
    {   
        $model = new Cases();
        if(isset($_POST['Cases']))
        {
            $empmail  = '';
            if(!empty($_POST['Cases']['CcoEmail']))
                $empmail  = explode(',',$_POST['Cases']['CcoEmail']);
                
            $sendMail = Yii::$app->mailer->compose()
                  ->setFrom("renukakul93@gmail.com","Advocate SPT")
                  ->setTo($_POST['Cases']['partyEmail'])
                  ->setCc($empmail)
                  ->setSubject($_POST['Cases']['subjectEmail'])
                  ->setHtmlBody($_POST['Cases']['bodyEmail'])
                  ->send();     
            return $this->redirect(['index']);                                                  
        }        
        return $this->renderAjax('compose_mail', [
            'model' => $model,
        ]);
    }    
}
