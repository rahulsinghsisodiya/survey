<?php
//use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use lavrentiev\widgets\toastr\Notification;

/**
 * Yii console bootstrap file.
 *
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */
defined('YII_DEBUG') or define('YII_DEBUG', true);



function p($p, $exit = 1)
    {
        echo '<pre>';
        print_r($p);
        echo '</pre>';
        if ($exit == 1)
        {
            exit;
        }
    }


function notification($type = null, $message = null)
{
	$type    = empty($type)    ? 'success' : $type;
	$message = empty($message) ? '' : $message;
	echo Notification::widget([
    'type'    => $type,
    'title'   => '',
    'message' => $message,
    'options' => ["closeButton" => false]
]);
}    