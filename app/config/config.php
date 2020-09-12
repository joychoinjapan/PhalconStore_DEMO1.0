<?php
use Phalcon\Config\Adapter\Ini as ConfigIni;

/*
 * Modified: prepend directory path of current file, because of this file own different ENV under between Apache and command line.
 * NOTE: please remove this comment.
 */
defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/../..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/app');

$database_config = new ConfigIni(BASE_PATH.'/database_config.ini');
return new \Phalcon\Config([
    'database' => [
        'adapter'     => $database_config->adapter,
        'host'        => $database_config->host,
        'username'    => $database_config->username,
        'password'    => $database_config->password,
        'dbname'      => $database_config->dbname,
        'charset'     => $database_config->charset,
    ],
    'application' => [
        'appDir'         => APP_PATH . '/',
        'controllersDir' => APP_PATH . '/controllers/',
        'modelsDir'      => APP_PATH . '/models/',
        'migrationsDir'  => APP_PATH . '/migrations/',
        'viewsDir'       => APP_PATH . '/views/',
        'pluginsDir'     => APP_PATH . '/plugins/',
        'libraryDir'     => APP_PATH . '/library/',
        'cacheDir'       => BASE_PATH . '/cache/',
        'baseUri'        => '/',
    ]
]);
