<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Customer */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Customer',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Customers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="customer-create">
  <div class="box box-primary">
      <div class="">
        <div class="row">
           <div class="col-sm-12">
          		<h5 class="form-heading"><?= Yii::t('app','Update Customer') ?></h5>
          </div>
        </div>
       <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>
  </div>
</div>


