
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Change Password';
$this->params['breadcrumbs'][] = $this->title;
?>
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
              <?php $form = ActiveForm::begin(['id' => 'change-password']); ?>
                  <div class="box-body">
                   <div class="row">
                      <label class="col-sm-2 text-right" for="inputEmail3">Current Password</label>
                      <div class="col-sm-6">
                            <?= $form->field($model, 'current_password')->passwordInput(['autofocus' => true,'placeholder'=>'Current Password'])->label(false) ?>
                      </div>
                    </div>
                    <div class="row">
                      <label class="col-sm-2 text-right" for="inputEmail3">New Password</label>
                      <div class="col-sm-6">
                            <?= $form->field($model, 'password')->passwordInput(['autofocus' => true,'placeholder'=>'New Password'])->label(false) ?>
                      </div>
                    </div>
                    <div class="row">
                      <label class="col-sm-2 text-right" for="inputEmail3">Confirm Password</label>
                      <div class="col-sm-6">
                            <?= $form->field($model, 'password_repeat')->passwordInput(['autofocus' => true,'placeholder'=>'Confirm Password'])->label(false) ?>
                      </div>
                    </div>
                  </div>
                  <div class="box-footer">
                    <div class="row">
                     <div class="">
                        <label class="col-sm-2 text-right" for="inputEmail3"></label>
                        <div class="col-sm-6">
                             <?= Html::submitButton('Submit', ['class' => 'btn btn-primary ', 'name' => 'login-button']) ?>
                        </div>
                      </div>
                   </div> 
                  </div>
               <?php ActiveForm::end(); ?>
              </div>
        </div>
    </div>