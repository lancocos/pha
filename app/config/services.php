<?php

use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Session as FlashSession;
use Phalcon\Flash\Direct as FlashDirect;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Events\Manager as EventManager;
/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->setShared('url', function () use ($config) {
    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);
    return $url;
});

/**
 * Setting up the view component
 */
$di->setShared('view', function () use ($config) {
    $view = new View();
    $view->setDI($this);
    $view->setViewsDir(APP_PATH.'/'.$config->application->viewsDir);

    $view->registerEngines([
        '.volt' => function ($view) use ($config) {
            $volt = new VoltEngine($view, $this);
            $volt->setOptions([
                'compiledPath' => BASE_PATH.'/'.$config->application->cacheDir,
                'compiledSeparator' => '_'
            ]);

            return $volt;
        },
        '.phtml' => PhpEngine::class

    ]);

    return $view;
});

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->setShared('db', function () use ($config) {
    $class = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
    $params = [
        'host'     => $config->database->host,
        'username' => $config->database->username,
        'password' => $config->database->password,
        'dbname'   => $config->database->dbname,
        'charset'  => $config->database->charset
    ];

    if ($config->database->adapter == 'Postgresql') {
        unset($params['charset']);
    }
    $manager = new \Phalcon\Events\Manager();
    $profiler = new \Phalcon\Db\Profiler();
    $manager->attach("db:beforeQuery",  function($event,$conn) use ($profiler){
        $profiler->startProfile($conn->getSQLStatement());
    });
    $manager->attach("db:afterQuery",  function($event,$conn) use ($profiler){
        $profiler->stopProfile();
        $profile = $profiler->getLastProfile();
        $sql = $profile->getSQLStatement();
        $param = $conn->getSqlVariables();
        $executeTime = $profile->getTotalElapsedSeconds();
        (is_array($param) && count($param)) && $param = json_encode($param);
        $logger = new Phalcon\Logger\Adapter\File(APP_PATH."/sqllog/sql-".date('Ymd').".txt");
        $logger->log("[".$executeTime." ms ] ".$sql.$param);
    });
    $connection = new $class($params);
    $connection->setEventsManager($manager);
    return $connection;
});


/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->setShared('modelsMetadata', function () {
    return new MetaDataAdapter();
});

/**
 * Register the session flash service with the Twitter Bootstrap classes
 */
$di->set('flash', function () {
    return new FlashSession([
        'error'   => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice'  => 'alert alert-info',
        'warning' => 'alert alert-warning'
    ]);
});

/**
 * Start the session the first time some component request the session service
 */
$di->setShared('session', function () {
    $session = new SessionAdapter();
    $session->start();

    return $session;
});

$di->set('dispatcher',function(){
    $eventManager = new EventManager();
    $eventManager->attach('dispatch:beforeExecuteRoute',new SecurityPlugin());
    $eventManager->attach('dispatch:beforeException', new NotFoundPlugin());


    $dispatcher = new Dispatcher();
    $dispatcher->setEventsManager($eventManager);
    return $dispatcher;
},true);
$di->set('zbb',function(){
    return new ZBB();
});

$di->set('ui',HelloElement::class);

$di->set('zbb1',[
    'className'=>ZBA::class,
    "calls"     => [
        [
            "method"    => "setResponse",
            "arguments" => [
                [
                    "type" => "service",
                    "name" => "response",
                ]
            ]
        ],
        [
            "method"    => "setFlag",
            "arguments" => [
                [
                    "type"  => "parameter",
                    "value" => 0,
                ]
            ]
        ]
    ]
]);

