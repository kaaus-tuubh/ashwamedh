<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PartyEmployee */

$this->title = 'Update Party Employee: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Party Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="party-employee-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
