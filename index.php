<?php

require __DIR__.'/vendor/autoload.php';


$log = new Monolog\Logger('name');
var_dump($log);exit();
$log->pushHandler(new Monolog\Handler\StreamHandler('app.log', Monolog\Logger::WARNING));

$log->addWarning('Foo');