
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
.form-group.has-error .form-control, .form-group.has-error .input-group-addon {
  border-color: #BC3232;
  box-shadow: none;
}
</style>
<div class="login-box">
 <div class="login-logo">
    <?=Html::img('@web/images/logo.png');?>
    <!-- <a href="../../index2.html"><b>Admin</b>LTE</a> -->
  </div>
  <div class="login-logo">
  
  <b>Reset</b> Password
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Enter your new password hear</p>

     <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
      <div class="form-group has-feedback">
         <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control','placeholder'=>'Password'])->label(false) ?>
        <span class="glyphicon glyphicon-lock form-control-feedback login_icon"></span>
      </div>
   <div class="form-group has-feedback">
         <?= $form->field($model, 'password_repeat')->passwordInput(['class' => 'form-control','placeholder'=>'Confirm New Password'])->label(false) ?>
        <span class="glyphicon glyphicon-lock form-control-feedback login_icon"></span>
      </div>
   <div class="row">
         <div class="col-xs-8 forget-password">
         </div>
         <div class="col-xs-4">
            <?= Html::submitButton('Submit', ['class' => 'btn  btn-block btn-flat login_button', 'name' => 'login-button']) ?>
         </div>
    </div>
    <?php ActiveForm::end(); ?>
    <!-- /.social-auth-links -->

   
  </div>
  <!-- /.login-box-body -->
</div>

