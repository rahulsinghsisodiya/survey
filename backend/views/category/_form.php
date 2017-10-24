<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">
    <div class="customer-form">
        <?php $form = ActiveForm::begin(); ?>

        <div class="row">
            <div class="col-sm-12">
                <label class="col-sm-2 labels" for="inputEmail3">Title</label>
                <div class="col-sm-6">
                    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label(false) ?>

                </div>
            </div>
        </div> 
        
        <div class="row">
            <div class="col-sm-12 submit_button">
                <label class="col-sm-2"></label>
                <div class="col-sm-6">
                    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
            </div>
        </div>  
    </div>
</div>
</div>  

</div>

<?php ActiveForm::end(); ?>

</div>
</div>
