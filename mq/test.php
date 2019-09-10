<?php


require __DIR__.'/vendor/autoload.php'; //引入自动加载的文件

$connect = new \FuseSource\Stomp\Stomp('tcp://129.28.195.216:61613/01.php');
$connect->connect();

$userId = 1001;
$result = $connect->send('email',$userId); //比如发邮件
var_dump($result);


