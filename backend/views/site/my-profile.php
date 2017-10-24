
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'My Profile';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="campaign-create">
  <div class="box box-primary">
      <div class="campaign-index">
    <div class="row">
          <div class="col-sm-12">
      <h5 class="form-heading"><?= Yii::t('app','Edit Profile') ?></h5>
      </div>
    </div>
       <div class="">
              <?php $form = ActiveForm::begin(['id' => 'username']); ?>
                  <div class="box-body" style="margin-left:15px;">
                  <div class="row">
                   <div class="">
                      <label class="col-sm-1 text-right" for="inputEmail3">Username</label>
                      <div class="col-sm-6">
                            <?=  $form->field($model, 'username')->textInput(['value'=> $model->username, 'autofocus' => true,'placeholder'=>'Username'])->label(false) ?>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                     <div class="">
                        <label class="col-sm-1 text-right" for="inputEmail3">Email</label>
                        <div class="col-sm-6">
                              <?=  $form->field($model, 'email')->textInput(['value'=> $model['email'], 'autofocus' => true,'placeholder'=>'Email'])->label(false) ?>
                        </div>
                      </div>
                   </div> 
                  <div class="row">
                     <div class="">
                        <label class="col-sm-1 text-right" for="inputEmail3">Profile Image</label>
                        <div class="col-sm-6">
                          <?= $form->field($model, 'profilepicture')->fileInput(['maxlength' => true,'class' => 'dropify','data-default-file'=>Yii::getAlias('@web/uploads/profileimage').'/'.$model['profile_picture'] ])->label(false) ?>
                        </div>
                      </div>
                   </div> 
                  </div>
                  <div class="box-footer">
                    <div class="">
                     <div class="">
                        <label class="col-sm-1 text-right" for="inputEmail3"></label>
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
</div>
 <?php

$script =<<<JS
    // for ckeditor
$(document).ready(function(){
    
    $('.dropify').dropify();
    });



JS;


$this->registerJs($script);

?>   