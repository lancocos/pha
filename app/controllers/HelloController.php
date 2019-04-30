<?php

class HelloController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
        echo 111;
        new ZBC();
        exit;
    }
    public function abcAction(){
        echo 123;
        $this->view->disable();
    }

}

