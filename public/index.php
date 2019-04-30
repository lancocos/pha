<?php
use Phalcon\Di\FactoryDefault;
use Phalcon\Config\Adapter\Ini as IniConfig;
error_reporting(E_ALL);
define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

$di = new FactoryDefault();
$config = new IniConfig(APP_PATH . "/config/config.ini");
include APP_PATH . '/config/loader.php';
include APP_PATH . '/config/router.php';
include APP_PATH . '/config/services.php';

try {

    $application = new \Phalcon\Mvc\Application($di);

    //echo str_replace(["\n","\r","\t"], '', $application->handle()->getContent());
    echo $application->handle()->getContent();
} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
