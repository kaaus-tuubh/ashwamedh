<?php 
use yii\helpers\Html;
use yii\helpers\Url;
?> 

<?php $username = Yii::$app->user->identity->username; ?>

  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $username;?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
     <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>    -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="">
          <?= Html::a('<i class="fa fa-dashboard"></i> <span>Dashboard</span>', ['/site/index'], ['class'=>''])?>
        </li>      
        <li class="">
          <?= Html::a('<i class="fa fa-users"></i> <span>Party Management</span>', ['/party/index'], ['class'=>''])?>
        </li>
        <li class="">
          <?= Html::a('<i class="fa fa-globe"></i> <span>Party Branches</span>', ['/party-branch/index'], ['class'=>''])?>
        </li>        
        <li class="">
          <?= Html::a('<i class="fa fa-book"></i> <span>Case Management</span>', ['/cases/index'], ['class'=>''])?>
        </li>
      <!--  <li class="">
          <?= Html::a('<i class="fa fa-envelope"></i> <span>Case Email</span>', ['/cases/mailbox'], ['class'=>''])?>
        </li>      -->          
        <li class="">
          <?= Html::a('<i class="fa fa-bar-chart"></i> <span>Case Report</span>', ['/cases/branchwisereport'], ['class'=>''])?>
        </li>        
      </ul>
    </section>
    <!-- /.sidebar -->
    </aside>

