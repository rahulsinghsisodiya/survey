
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
  
  <b>Forget</b> Password
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Enter your email to Reset your password</p>

     <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
      <div class="form-group has-feedback">
         <?= $form->field($model, 'email')->textInput(['autofocus' => true,'placeholder'=>'Email'])->label(false) ?>
        <span class="glyphicon glyphicon-envelope form-control-feedback login_icon"></span>
      </div>
    <div class="form-group has-feedback">
        <?= $form->field($model, 'captcha', [
                    'options'=>[
                      'tag'=>'div',
                      'class'=>'form-group',
                    ],
                    'template' => '{input}<div class="col-sm-12 col-xs-12">{error}</div>',
                ])->widget(Captcha::className(),[
                      'captchaAction' => 'site/captcha/',
                      'value' => '',
                      'options' => [
                          'placeholder' => 'Security Code',
                          'autocomplete' => 'off',
                          'class' => 'form-control input-etyle captcha'
                        ],
                      'template' => '<div class="col-md-7 col-sm-7 col-xs-7 no-padding">
                                        {input}
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-4 no-padding">
                                      <div class="login-imgcaptcha">
                                        {image}
                                      </div>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-1 no-padding reload_captcha">
                                      <span class="glyphicon glyphicon-refresh refresh-captcha pointer"></span>
                                    </div>'
                    ])->label(false); ?>

      </div>
    <div class="row forget">
         <div class="col-xs-8 forget-password">
            <?= Html::a('Back to Sign In', ['site/login']) ?>
         </div>
         <div class="col-xs-4">
            <?= Html::submitButton('Send Email', ['class' => 'btn  btn-block btn-flat login_button', 'name' => 'login-button']) ?>
         </div>
    </div>
    
    <?php ActiveForm::end(); ?>
    <!-- /.social-auth-links -->

   
  </div>
  <!-- /.login-box-body -->
</div>
<?php

$script =<<<JS

    $('input').iCheck({
      checkboxClass: 'icheckbox_square-red',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });

    $('.refresh-captcha').on('click', function(e){
      e.preventDefault();
      $('#passwordresetrequestform-captcha-image').yiiCaptcha('refresh');
    });

JS;

$this->registerJs($script);
?>