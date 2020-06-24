<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\PartyEmployee */

$this->title = 'Create Party Employee';
$this->params['breadcrumbs'][] = ['label' => 'Party Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="party-employee-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
