<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">
  <div class="customer-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
      <div class="col-sm-12">
        <label class="col-sm-2 labels" for="inputEmail3">First Name
        </label>
        <div class="col-sm-6">
          <?= $form->field($model, 'first_name')->textInput(['maxlength' => true])->label(false) ?>
        </div>
      </div>
    </div> 
    <div class="row">
      <div class="col-sm-12">
        <label class="col-sm-2 labels" for="inputEmail3">Last Name
        </label>
        <div class="col-sm-6">
          <?= $form->field($model, 'last_name')->textInput(['maxlength' => true])->label(false) ?>
        </div>
      </div>
    </div> 
    <div class="row">
      <div class="col-sm-12">
        <label class="col-sm-2 labels" for="inputEmail3">Dob
        </label>
        <div class="col-sm-6">
          <?= $form->field($model, 'dob')->textInput()->label(false) ?>
        </div>
      </div>
    </div> 
    <div class="row">
      <div class="col-sm-12">
        <label class="col-sm-2 labels" for="inputEmail3">Address
        </label>
        <div class="col-sm-6">
          <?= $form->field($model, 'address')->textarea(['rows' => 6])->label(false) ?>
        </div>
      </div>
    </div> 
    <div class="row">
      <div class="col-sm-12">
        <label class="col-sm-2 labels" for="inputEmail3">City
        </label>
        <div class="col-sm-6">
          <?= $form->field($model, 'city')->textInput(['maxlength' => true])->label(false) ?>
        </div>
      </div>
    </div> 
    <div class="row">
      <div class="col-sm-12">
        <label class="col-sm-2 labels" for="inputEmail3">Email
        </label>
        <div class="col-sm-6">
          <?= $form->field($model, 'email')->textInput(['maxlength' => true])->label(false) ?>
        </div>
      </div>
    </div> 
    <div class="row">
      <div class="col-sm-12">
        <label class="col-sm-2 labels" for="inputEmail3">Phone Number
        </label>
        <div class="col-sm-6">
          <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true])->label(false) ?>
        </div>
      </div>
    </div> 
    <div class="row">
      <div class="col-sm-12">
        <label class="col-sm-2 labels" for="inputEmail3">Shoe Size
        </label>
        <div class="col-sm-6">
          <?= $form->field($model, 'shoe_size')->textInput(['maxlength' => true])->label(false) ?>
        </div>
      </div>
    </div> 
    <div class="row">
      <div class="col-sm-12">
        <label class="col-sm-2 labels" for="inputEmail3">Jeans Size
        </label>
        <div class="col-sm-6">
          <?= $form->field($model, 'jeans_size')->textInput(['maxlength' => true])->label(false) ?>
        </div>
      </div>
    </div> 
    <div class="row">
      <div class="col-sm-12">
        <label class="col-sm-2 labels" for="inputEmail3">Shirt Size
        </label>
        <div class="col-sm-6">
          <?= $form->field($model, 'shirt_size')->textInput(['maxlength' => true])->label(false) ?>
        </div>
      </div>
    </div> 
    <div class="row">
      <div class="col-sm-12">
        <label class="col-sm-2 labels" for="inputEmail3">Blouse Size
        </label>
        <div class="col-sm-6">
          <?= $form->field($model, 'blouse_size')->textInput(['maxlength' => true])->label(false) ?>
        </div>
      </div>
    </div> 
    <div class="row">
      <div class="col-sm-12">
        <label class="col-sm-2 labels" for="inputEmail3">Status
        </label>
        <div class="col-sm-6">
          <?= $form->field($model, 'status')->dropDownList([ 'Enable' => 'Enable', 'Disable' => 'Disable' ], ['prompt' => 'Select Status'])->label(false) ?>
        </div>
      </div>
    </div> 
    <div class="row">
      <div class="col-sm-12">
        <label class="col-sm-2 labels" for="inputEmail3">Created At
        </label>
        <div class="col-sm-6">
          <?= $form->field($model, 'created_at')->textInput()->label(false) ?>
        </div>
      </div>
    </div> 
    <div class="row">
      <div class="col-sm-12">
        <label class="col-sm-2 labels" for="inputEmail3">Updated At
        </label>
        <div class="col-sm-6">
          <?= $form->field($model, 'updated_at')->textInput()->label(false) ?>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 submit_button">
        <label class="col-sm-2 labels" for="inputEmail3"></label>
        <div class="col-sm-6">
           <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
      </div>
    </div>  
    
    <?php ActiveForm::end(); ?>
  </div>
</div>
