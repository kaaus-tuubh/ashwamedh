<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\DashboardAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

DashboardAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition skin-blue-light sidebar-mini">
<?php $this->beginBody() ?>

<div class="wrapper">

    <?php $this->beginContent('@app/views/layouts/header.php'); ?>
    <!-- You may need to put some content here -->
    <?php $this->endContent(); ?>

    <?php $this->beginContent('@app/views/layouts/sidebar.php'); ?>
    <!-- You may need to put some content here -->
    <?php $this->endContent(); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
     <!-- <section class="content-header">
        <h1>
          Dashboard
          <small>Control panel</small>
        </h1>  
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Dashboard</li>
        </ol>
      </section>   -->
  
      <!-- Main content -->
      <section class="content">
          <?= $content ?>
      </section>
      <!-- /.content -->   
           
    </div>                             
    <!-- /.content-wrapper -->    
    
    
    <?php $this->beginContent('@app/views/layouts/footer.php'); ?>
    <!-- You may need to put some content here -->
    <?php $this->endContent(); ?>
    
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
