<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Category */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
            'modelClass' => 'Category',
        ]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="category-create">

    <div class="customer-create">
        <div class="box box-primary">
            <div class="">
                <div class="row">
                    <div class="col-sm-12">
                        <h5 class="form-heading"><?= Html::encode($this->title) ?></h5>
                    </div>
                </div>
                <?=
                $this->render('_form', [
                    'model' => $model,
                ])
                ?>
            </div>
        </div>
    </div>
</div>

