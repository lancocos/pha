<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/30
 * Time: 15:48
 */

class LoginController extends ControllerBase
{

    public function indexAction(){
        echo "<pre>";
        print_r($this->di->get('dispatcher'));
        $this->view->disable();
    }
}