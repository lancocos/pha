<?php
use Phalcon\DiInterface;
use Phalcon\Di\InjectionAwareInterface;

class ZBA
{
    /**
     * @var DiInterface
     */

    protected $response;
    protected $flag;


    public function setResponse(\Phalcon\Http\Response $resp){

        $this->response =$resp;
    }
    public function setFlag($flag){
        $this->flag=$flag;
    }

    public function write(){

    }
    public function read(){
        return $this->response->setContent("<html><body>".$this->flag."</body></html>")->setContentLength(2048)->send();
    }
}