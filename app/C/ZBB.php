<?php
use Phalcon\DiInterface;
use Phalcon\Di\InjectionAwareInterface;

class ZBB implements InjectionAwareInterface
{
    /**
     * @var DiInterface
     */
    protected $_di;
    protected $response1;
    protected $flag;


    public function setDi(DiInterface $di)
    {
        $this->_di = $di;
    }

    public function getDi()
    {
        return $this->_di;
    }

    public function write(){
       $this->_di->get('session')->set('name','imwz');
    }
    public function read(){
        return $this->_di->get('session')->get('name');
    }

    public function setResponse(\Phalcon\Http\Response $resp){
        $resp2 = new \Phalcon\Http\Response();
        var_dump($resp2);
        $this->response1 =$resp2;
    }
    public function setFlag($flag){
        $this->flag=$flag;
    }
}