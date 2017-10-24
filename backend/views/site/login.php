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
  border-color: #000;
  box-shadow: none;
}
.form-control:focus
{
  border-color: #000;
}

.checkbox > label {
  color: #000 !important;
}
</style>

<div class="login-box">
  <div class="login-logo">
    
  </div>
  <div class="login-logo">
  
  <b>Admin</b> Login
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

      <div class="form-group has-feedback">
         <?= $form->field($model, 'email')->textInput(['autofocus' => true,'placeholder'=>'Email'])->label(false) ?>
        <span class="glyphicon glyphicon-envelope form-control-feedback login_icon"></span>
      </div>

      <div class="form-group has-feedback">
          <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control','placeholder'=>'Password'])->label(false) ?>
        <span class="glyphicon glyphicon-lock form-control-feedback login_icon"></span>
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
                                    <div class="col-md-1 col-sm-1 col-xs-1 no-padding ">
                                      <span class="glyphicon glyphicon-refresh refresh-captcha pointer"></span>
                                    </div>'
                    ])->label(false); ?>
      </div>

      <div class="row">
        <div class="col-xs-12 icheck-box">
          <?= $form->field($model, 'rememberMe')->checkbox()->label('Remember Me') ?>
        </div>
      </div>

    <div class="row">
         <div class="col-xs-8 forget-password">
            <?= Html::a('I forgot my password', ['site/request-password-reset']) ?>
         </div>
         <div class="col-xs-4">
            <?= Html::submitButton('Sign In', ['class' => 'btn  btn-block btn-flat login_button', 'name' => 'login-button']) ?>
         </div>
    </div>
    <?php ActiveForm::end(); ?>


  </div>
  <!-- /.login-box-body -->
</div>
<div class="site-login" style="display:none">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <div class="row">
        <div class="col-lg-5">
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
      $('#loginform-captcha-image').yiiCaptcha('refresh');
    });

JS;

$this->registerJs($script);
?>