<?php
#composer的autoload学习

// echo  __DIR__.'\testhano';exit();
$loader = require __DIR__.'/vendor/autoload.php';
$loader->add('Acem\\Load\\', __DIR__);
$loader->add('Test\\Load\\', __DIR__);
var_dump($loader);

//在composer.json文件require Monolog之后直接new出来使用即可
$log = new Monolog\Logger('name');
// $log->pushHandler(new Monolog\Handler\StreamHandler('app.log', Monolog\Logger::WARNING));
// $log->addWarning('hano');
var_dump($log);exit();


// 你可以在 composer.json 的 autoload 字段中增加自己的 autoloader。

// {
//     "autoload": {
//         "psr-4": {"Acme\\": "src/"}
//     }
// }
// Composer 将注册一个 PSR-4 autoloader 到 Acme 命名空间。

// 你可以定义一个从命名空间到目录的映射。此时 src 会在你项目的根目录，与 vendor 文件夹同级。例如 src/Foo.php 文件应该包含 Acme\Foo 类。

// 添加 autoload 字段后，你应该再次运行 install 命令来生成 vendor/autoload.php 文件
use Acme\View;
View::getView();


// 引用这个文件也将返回 autoloader 的实例，你可以将包含调用的返回值存储在变量中，并添加更多的命名空间。这对于在一个测试套件中自动加载类文件是非常有用的，例如。

// $loader = require 'vendor/autoload.php';
// $loader->add('Acme\\Test\\', __DIR__);
use Acme\Load\View as View2;
View2::getHano();

use Test\Load\Hano;
Hano::getHano();

