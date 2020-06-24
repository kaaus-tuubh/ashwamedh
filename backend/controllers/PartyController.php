<?php

namespace backend\controllers;

use Yii;
use backend\models\Party;
use backend\models\PartySearch;
use backend\models\PartyEmployee;
use backend\models\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * PartyController implements the CRUD actions for Party model.
 */
class PartyController extends Controller
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
                'only' => ['index','create','update','view'],
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
     * Lists all Party models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PartySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Party model.
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
     * Creates a new Party model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Party();
        $empDetails = [new PartyEmployee];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $empDetails = Model::createMultiple(PartyEmployee::classname());
            Model::loadMultiple($empDetails, Yii::$app->request->post());
            
            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($empDetails) && $valid;
            
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($empDetails as $detail) {
                            $detail->party_id = $model->id;
                            if (! ($flag = $detail->save(false))) {
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
                'empDetails' => (empty($empDetails)) ? [new PartyEmployee] : $empDetails
            ]);
        }
    }

    /**
     * Updates an existing Party model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $empDetails = $model->partyEmployees;
         
        if ($model->load(Yii::$app->request->post())) {
            $oldIDs = ArrayHelper::map($empDetails, 'id', 'id'); 
            $empDetails = Model::createMultiple(PartyEmployee::classname(), $empDetails);
            Model::loadMultiple($empDetails, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($empDetails, 'id', 'id')));

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
            $valid = Model::validateMultiple($empDetails) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (! empty($deletedIDs)) {
                            PartyEmployee::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($empDetails as $detail) {
                            $detail->party_id = $model->id;
                            if (! ($flag = $detail->save(false))) {
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
            return $this->render('update', [
                'model' => $model,
                'empDetails' => (empty($empDetails)) ? [new PartyEmployee] : $empDetails
            ]);
        }
    }

    /**
     * Deletes an existing Party model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Party model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Party the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Party::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
