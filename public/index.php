<?php

use Phalcon\Di\FactoryDefault;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\Url;
use Phalcon\Debug;
use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Config\Adapter\Ini as ConfigIni;


// Define some absolute path constants to aid in locating resources
define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

$debug = new Debug();
$debug->listen();

// オートローダーの登録
$loader = new Loader();

$loader->registerDirs(
    [
        APP_PATH . '/controllers/',
        APP_PATH . '/models/',
    ]
);

$loader->register();

$container = new FactoryDefault();
//$container->set(
//    'db',
//    function (){
//        return new Mysql([
//            'host'        => '192.168.10.10',
//            'username'    => 'root',
//            'password'    => 'jojoCHU_1234',
//            'dbname'      => 'store'
//        ]);
//    }
//);
$database_config = new ConfigIni(BASE_PATH.'/database_config.ini');
$container->set(
    'db',
    function () use($database_config){
        return new Mysql(
            [
                'host'     => $database_config->host,
                'username' => $database_config->username,
                'password' => $database_config->password,
                'dbname'   => $database_config->dbname
            ]
        );
    }
);


$container->set(
    'view',
    function () {
        $view = new View();
        $view->setViewsDir(APP_PATH . '/views/');
        return $view;
    }
);

$container->set(
    'url',
    function () {
        $url = new Url();
        $url->setBaseUri('/');
        return $url;
    }
);



$application = new Application($container);

try {
    // Handle the request
    $response = $application->handle(
        $_SERVER["REQUEST_URI"]
    );

    $response->send();
} catch (\Exception $e) {
    echo 'Exception: ', $e->getMessage();
}