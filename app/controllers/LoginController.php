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
        if($this->request->ispost()){
           $validation = new LoginValidation();

            $messages = $validation->validate($this->request->get());
            if(count($messages)){
                foreach ($messages AS $message){
                    echo $message."<br/>";
                }
            }
            $this->view->disable();
            return;
        }
        $loginForm = new LoginForm();
        $this->view->setVar('form',$loginForm);
        //$this->view->disable();
    }
}