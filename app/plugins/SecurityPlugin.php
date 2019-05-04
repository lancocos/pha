<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/30
 * Time: 16:14
 */
use Phalcon\Mvc\User\Plugin;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Events\Event;
class SecurityPlugin extends Plugin
{
    public function beforeExecuteRoute(Event $event,Dispatcher $dispatcher){
        /*
        $auth =$this->session->get('auth');
        $controller = $dispatcher->getControllerName();
        if(!$auth && $controller!= 'login'){
            $dispatcher->forward(
                [
                    "controller" => "login",
                    "action"     => "index",
                ]
            );
            return false;
        }
        */

    }

}