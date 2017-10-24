<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Campaign */
$this->title = Yii::t('app', 'Mail API Settings');;
/*$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Global Settings'), 'url' => ['index']];*/
$this->params['breadcrumbs'][] = $this->title ;
?>
<div class="campaign-create">
	<div class="box box-primary">
	    <div class="campaign-index">
			<div class="row">
	      	  <div class="col-sm-12">
				<h5 class="form-heading"><?= Yii::t('app','Mail API Settings') ?></h5>
			  </div>
			</div>
		    <?= $this->render('_form', [
		        'settings' => $settings,
		    ]) ?>

		</div>
	</div>
</div>


