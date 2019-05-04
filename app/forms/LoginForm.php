<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/4
 * Time: 8:34
 */

class LoginForm extends Phalcon\Forms\Form
{
    public function initialize(){
        $this->add(new \Phalcon\Forms\Element\Text('username'));
        $this->add(new \Phalcon\Forms\Element\Password('userpass'));
        $this->add(new \Phalcon\Forms\Element\Check('remember'));
        $this->add(new \Phalcon\Forms\Element\Hidden('csrf'));
    }

    public function getCsrf(){
        return $this->security->getToken();
    }
}