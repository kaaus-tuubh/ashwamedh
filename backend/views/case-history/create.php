<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CaseHistory */

$this->title = 'Create Case History';
$this->params['breadcrumbs'][] = ['label' => 'Case Histories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="case-history-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
