<?php
use Phalcon\Loader;

$loader = new Loader();
$loader->registerClasses([
    'ZBC'=>APP_PATH.'/C/ZBC.php',
]);

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs(
    [
        APP_PATH.'/'.$config->application->controllersDir,
        APP_PATH.'/'.$config->application->modelsDir,
        APP_PATH.'/'.$config->application->formsDir,
        APP_PATH.'/'.$config->application->pluginsDir,
        APP_PATH.'/'.$config->application->libraryDir,
    ]
);
$loader->register();

include '../vendor/autoload.php';