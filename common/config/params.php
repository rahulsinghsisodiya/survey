<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
];

function pr($data){
	echo '<pre>';
	print_r($data);
}

function prd($data){
	echo '<pre>';
	print_r($data);
	exit;
}