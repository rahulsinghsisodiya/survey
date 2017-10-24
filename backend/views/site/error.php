<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;
  
$title='';
switch($exception->statusCode){
    case 404:
    $title = 'Page Not Found';
    
    case 403:
    $title = 'Unauthorized Access';
    break;
    default:
    $title = 'Page Not Found';
    break;
}
$this->title = $title;

?>
<?php 
 $isGuest = Yii::$app->user->isGuest;
if(!$isGuest){ ?>

<?php
}
?>

<?php
if($exception->statusCode == 403){
?>

<div class="site-error">
    <section class="content">
          <div class="error-page col-sm-offset-2 col-sm-8 col-xm-12">
            <h2 class="headline text-red"> 403</h2>
            <div class="error-content">
              <h3><span class="glyphicon glyphicon-alert text-red"></span>&nbsp;Oops! unauthorized access.</h3>
              <p>
                You have to logout before validating Invitation Acceptance Key
                <?php
                if($isGuest)
                 echo "Meanwhile, you may ". Html::a('return to '.$return_page,Url::to(['site/login'],[])); ?>.                
              </p>
            </div>
          </div>
        </section>
</div>
<?php
  }
else if($exception->statusCode == 500){
?>
<div class="site-error">
    <section class="content">
          <div class="error-page col-sm-offset-2 col-sm-8 col-xm-12">
            <h2 class="headline text-red"> 500</h2>
            <div class="error-content">
              <h3><span class="glyphicon glyphicon-alert text-red"></span>&nbsp;Oops! unauthorized access.</h3>
              <p>
                You are accessing reset password link, it is not valide untill you are loggedin.
                <?php
                if($isGuest)
                 echo "Meanwhile, you may ". Html::a('return to '.$return_page,Url::to(['widget/index'],[])); ?>.                
              </p>
            </div>
          </div>
        </section>
</div>
<?php
  }
  else if($exception->statusCode == 405){
?>
<div class="site-error">
    <section class="content">
          <div class="error-page col-sm-offset-2 col-sm-8 col-xm-12">
            <h2 class="headline text-red"> 403</h2>
            <div class="error-content">
              <h3><span class="glyphicon glyphicon-alert text-red"></span>&nbsp;Oops! Token has expired.</h3>
              <p>
                You have a expired token, it is not valide now. Please try again forget password to get new reset password link.
              </p>
            </div>
          </div>
        </section>
</div>
<?php
  }
  else{
?>
<div class="site-error">
    <section class="content">
          <div class="error-page col-sm-offset-2 col-sm-8 col-xm-12">
            <h2 class="headline text-red"> 404</h2>
            <div class="error-content">
              <h3><span class="glyphicon glyphicon-alert text-red"></span>&nbsp;Oops! Page not found.</h3>
              <p>
                We could not find the page you were looking for.
                <?php 
                if($isGuest)
                 echo "Meanwhile, you may ". Html::a('return to '.$return_page,Url::to(['site/login'],[])); ?>.
              </p>
            </div>
          </div>
        </section>
</div>
<?php }
?>