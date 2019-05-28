<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/28
 * Time: 11:01
 */

class Session1Controller extends Phalcon\Mvc\Controller
{
    public function loginAction(){

        if($this->request->isPost()){
            $user_name = $this->request->getPost('email','string');
            $user_pass = $this->request->getPost('password','string');

            $user = Users1::FindFirst([
                'email=:email:',
                'bind'=>[
                    'email'=>$user_name,
                ],
            ]);
            if($user){
                if($this->security->checkHash($user_pass,$user->password)){
                    $this->session->set('user',$user);
                    $this->flash->success("success");
                    return $this->dispatcher->forward([
                        'controller'=>'profile',
                        'action'=>'info',

                    ]);
                }else{
                    $this->flash->error("password error!");
                    return $this->response->redirect('/session1/index');
                }
            }else{
                $this->flash->error("login failed");
                return $this->response->redirect('/session1/index');

            }

        }

    }

    public function indexAction(){

    }

    public function abcAction(){

    }

    public function regAction(){
        if($this->request->isPost()){
            $user_name = $this->request->getPost('email','string');
            $user_pass = $this->request->getPost('password','string');
            $user_pass = $this->security->hash($user_pass);
            $user = new Users1();
            $user->email = $user_name;
            $user->password = $user_pass;
            if($user->save()){
                $this->flash->success("register successfully");
                return $this->dispatcher->forward([
                    'controller'=>'session1',
                    'action'=>'index',
                ]);
            }else{

                $this->flash->error($user->getMessages()[0]->getMessage());
                return $this->response->redirect('session1/reg');
            }

        }
    }
}