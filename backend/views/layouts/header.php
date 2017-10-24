<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">'.Yii::$app->name.'</span><span class="logo-lg">' . Html::img('@web/images/logo.png') . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>
      <!-- Logo -->
    <!-- <a href="index2.html" class="logo">
      <span class="logo-mini"><b>A</b>LT</span>
      <span class="logo-lg"></span>
    </a> -->

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                        <?php
                            $url = (file_exists(Yii::$app->basePath.'/web/uploads/profileimage/'. Yii::$app->user->identity->profile_picture) && !empty(Yii::$app->user->identity->profile_picture)) ? Yii::getAlias('@web').'/uploads/profileimage/'. Yii::$app->user->identity->profile_picture : Yii::getAlias('@web').'/uploads/profileimage/default.png';

                            echo Html::img($url ,["class"=>"user-image", "alt"=>"User Image"]); ?>

                        <span class="hidden-xs"><?=Yii::$app->user->identity->fullname ?></span>
                    </a>
                    <ul class="dropdown-menu" style="width:150px;">
                        
                         <!-- Menu Body -->
                        <li class="user-body" style="padding:0px;">
                          <div class="">
                                <?= Html::a('Change Password', ['site/change-password'], ['class' => '']) ?>
                            </div>
                            <div class="">
                               <?= Html::a('My Profile', ['site/my-profile'], ['class' => '']) ?>
                            </div>
                            <div class="">
                                <?=Html::beginForm(['/site/logout'], 'post');?>
                                <?=Html::submitButton('Sign out',['class' => '']);?>
                                <?=Html::endForm();?>
                            </div>
                        <!-- /.row -->
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
</header>
<?php $Script =<<<JS
 window.setTimeout(function() {
        $(".alert:visible").fadeTo(1000, 0).slideUp(300, function(){
            $(this).hide();
        });
    }, 5000);
JS;
echo $this->registerJs($Script);
?>