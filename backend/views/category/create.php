<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Category */

$this->title = Yii::t('app', 'Create Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
