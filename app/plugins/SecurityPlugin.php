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
use Phalcon\Acl\Adapter\Memory AS AclList;
use Phalcon\Acl;
use Phalcon\Acl\Resource;
use Phalcon\Acl\Role;
class SecurityPlugin extends Plugin
{
    public function beforeExecuteRoute(Event $event,Dispatcher $dispatcher){


        $role = 'guest';
        $auth =$this->session->get('user');
        if($auth){
            $role = 'member';
        }
        $controller = $dispatcher->getControllerName();
        $action = $dispatcher->getActionName();

        $acl = $this->getAcl();

        $allowed = $acl->isAllowed($role, $controller, $action);
        if (!$allowed) {
            $this->flash->error("You don't have access to this module");

            $dispatcher->forward(
                array(
                    'controller' => 'session1',
                    'action' => 'index'
                )
            );

            return false;
        }



    }

    public function getAcl(){
       // if(!$this->persistent->acl){

            $acl = new AclList();
            $acl->setDefaultAction(Acl::DENY);
            $roles = [
                'member'=>new Role('member'),
                'guest'=>new Role('guest')
            ];
            foreach ($roles as $role) {
                $acl->addRole($role);
            }

            $privateResources  = [
                'profile'=>['info','write','pub','write'],
            ];
            foreach ($privateResources as $resourceName => $actions) {
                $acl->addResource(
                    new Resource($resourceName),
                    $actions
                );
            }
            $publicResources  = [
                'session1'=>['index','abc','reg','login'],
                //'test'=>['index','search','new','edit','create','save','delete'],
                'hello'=>['index','abc','db','find'],
                //'index'=>['index'],
                //'login'=>['index'],
            ];

            foreach ($publicResources as $resourceName => $actions) {
                $acl->addResource(
                    new Resource($resourceName),
                    $actions
                );
            }


            // 授权user和Grant访问公共区域
            foreach ($roles as $role) {
                foreach ($publicResources as $resource => $actions) {
                    $acl->allow(
                        $role->getName(),
                        $resource,
                        "*"
                    );
                }
            }

            // 授权仅角色Users 访问私有区域
            foreach ($privateResources as $resource => $actions) {
                foreach ($actions as $action) {
                    $acl->allow(
                        "member",
                        $resource,
                        $action
                    );
                }
            }

            return $acl;
            //$this->persistent->acl = $acl;

        //}
        //return $this->persistent->acl;
    }

}