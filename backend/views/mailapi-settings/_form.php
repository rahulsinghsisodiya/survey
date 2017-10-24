<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\GlobalSettings */
/* @var $form yii\widgets\ActiveForm */
/*Mail API Settings*/
?>

<div class="row">
      <div class="col-sm-12">
        <div class="campaign-form">
            <?php $form = ActiveForm::begin(); ?>
    <?php
    	foreach ($settings as $key => $model): ?>
    		<div class="row">
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6 text-right mandatory-fields">
                    <?=Html::label($model->setting_name, [])?>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                    <?= $form->field($settings[$key], "[$key]setting_value")
                    		->textInput([ 'maxlength' => true, 'value' => $settings[$key]->setting_value])->label(false)
					?>
					<?= $form->field($settings[$key], "[$key]setting_name")
                    		->hiddenInput(['value' => $settings[$key]->setting_name])->label(false)
					?>
					<?= $form->field($settings[$key], "[$key]setting_type")
                    		->hiddenInput(['value' => $settings[$key]->setting_type])->label(false)
					?>
                </div>
            </div>
    <?php
    	endforeach;
    ?>
    <div class="row">
        <div class="col-lg-offset-2 col-lg-8 col-sm-offset-2 col-md-8 col-sm-offset-2 col-sm-8">
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
