<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap/css/bootstrap.min.css',
        'css/AdminLTE.css',
        'css/style.css',
        'plugins/iCheck/square/red.css',
        'css/skins/_all-skins.min.css',
        'css/custom.css',
        'css/dropify.css',
        'css/select2.css',
        'fonts/font-awesome/css/font-awesome.min.css',
        'plugins/timepicker/bootstrap-timepicker.css',
        'plugins/datepicker/datepicker3.css',
    ];
    public $js = [
     'js/jquery-ui.min.js',
     'js/bootstrap.min.js',
     'js/app.js',
     'js/jquery.toaster.js',
     'js/dropify.js',
     'js/select2.js',
     'plugins/iCheck/icheck.min.js',
     'plugins/timepicker/bootstrap-timepicker.min.js',
     'plugins/datepicker/bootstrap-datepicker.js',
     'js/custom.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
