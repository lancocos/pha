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
    public function beforeExcuteRoute(Event $event,Dispatcher $dispatcher){
        $auth =$this->session->get('auth');
        print_r($auth);
        //return false;
        $dispatcher->forward(
            [
                "controller" => "index",
                "action"     => "index",
            ]
        );

    }

}