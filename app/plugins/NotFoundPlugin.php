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
class NotFoundPlugin extends Plugin
{
    public function beforeException(Event $event,Dispatcher $dispatcher){

    }

}