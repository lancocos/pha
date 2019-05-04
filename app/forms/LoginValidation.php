<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/4
 * Time: 9:02
 */

class LoginValidation extends \Phalcon\Validation
{
    public function initialize(){
        $this->add('username',new \Phalcon\Validation\Validator\PresenceOf(
            ['message'=>'username is required']
        ));
        $this->add('userpass',new \Phalcon\Validation\Validator\PresenceOf(
            ['message'=>'userpass is required']
        ));
    }

    public function beforeValidation()
    {

    }
    public function afterValidation()
    {

    }
}