<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="login-box">
  <div class="login-logo">
    <a href="#">Adv<b>SPT</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in here</p>

    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
      
                      <?= $form->field($model, 'username',['options' =>
                                                            [
                                                              'tag' =>  'div',
                                                              'class'  => 'form-group has-feedback'
                                                            ],
                                                           'template'  =>'{input}<span class="glyphicon glyphicon-envelope form-control-feedback"></span>'                                                                                                                      
                                                          ])->textInput(['autofocus' => true]) ?>
      
                      <?= $form->field($model, 'password',['options' =>
                                                            [
                                                            'tag' =>  'div',
                                                            'class'  => 'form-group has-feedback'
                                                            ],
                                                            'template'  =>'{input}<span class="glyphicon glyphicon-lock form-control-feedback"></span>'
                                                          ])->passwordInput() ?>
      
                      <?= $form->field($model, 'rememberMe')->checkbox() ?>
      
                      <div class="form-group">      
                          <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>   
                      </div>
      
    <?php ActiveForm::end(); ?>
    <!--<div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div>
     /.social-auth-links -->

    <a href="#">I forgot my password</a><br>
    <!--<a href="register.html" class="text-center">Register a new membership</a>-->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->


<!--<div class="home-login">

    <div class="row">
        <!-- <div class="login-left col-lg-6 col-md-6">
                   
          <div id="myCarousel" class="carousel slide" data-ride="carousel">
              <!-- Indicators -->
         <!--     <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
              </ol>

            <!-- Wrapper for slides -->
      <!--      <div class="carousel-inner">
        
              <div class="item active">
                <img src="../web/images/pizza.jpg" alt="Los Angeles" style="width:100%;">
                <div class="carousel-caption">
                  <h3>Los Angeles</h3>
                  <p>LA is always so much fun!</p>
                </div>
              </div>
        
              <div class="item">
                <img src="../web/images/drink.jpg" alt="Chicago" style="width:100%;">
                <div class="carousel-caption">
                  <h3>Chicago</h3>
                  <p>Thank you, Chicago!</p>
                </div>
              </div>
            
              <div class="item">
                <img src="../web/images/ice.jpg" alt="New York" style="width:100%;">
                <div class="carousel-caption">
                  <h3>New York</h3>
                  <p>We love the Big Apple!</p>
                </div>
              </div>
          
            </div>

          </div>
        </div> -->
   <!--     <div class="login-right site-login">
          <h1><?= Html::encode($this->title) ?></h1>
      
          <p>Please fill out the following fields to login:</p>
      
          
                  <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
      
                      <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
      
                      <?= $form->field($model, 'password')->passwordInput() ?>
      
                      <?= $form->field($model, 'rememberMe')->checkbox() ?>
      
                      <div class="form-group">
                          <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                      </div>
      
                  <?php ActiveForm::end(); ?>
                   
          </div> 
    </div>

</div>       -->

