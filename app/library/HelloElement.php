<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/31
 * Time: 11:07
 */

class HelloElement extends \Phalcon\Mvc\User\Component
{
    private $user;
    public function __construct()
    {
        $this->user = $this->session->get('user');
    }

    public function getTab(){
        if($this->user){
            return 'welcome '.$this->user->email;
        }
        return 'guest';
    }
    public function getNav(){
        return 222;
    }

}