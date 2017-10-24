<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\LoginAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use lavrentiev\widgets\toastr\Notification;

LoginAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />
</head>
<body  class="hold-transition skin-blue sidebar-mini">
<?php $this->beginBody() ?>
<?= \lavrentiev\widgets\toastr\NotificationFlash::widget([
        'options' => [
            "closeButton" => false
           
        ]
    ]) ?>
<div class="wrapper">
<!--header start -->
  <?php echo $this->render('header.php');?>
<!--end header-->
<!--sidebar start-->
 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
           <?=Html::a('<i class="fa fa-dashboard"></i> <span>Dashboard</span>',['site/index'])?>
        </li>
       <li class="treeview">
            <?=Html::a('<i class="fa fa-user"></i> <span>Category</span>',['category/index'])?>
        </li>
      </ul>
    </section>
  </aside>
    <?php
      $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@backend/web/adminlte/dist');
    ?>
    <?= $this->render(
            'content.php',
            ['content' => $content, 'directoryAsset' => $directoryAsset]
    ) ?>
</div>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
