<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/29
 * Time: 11:23
 */
use  Phalcon\Mvc\Model\Criteria;
class AreaController extends ControllerBase
{
    public function indexAction(){
        $this->persistent->param = null;
        $this->view->form = new AreaForm();
    }
    public function searchAction(){
        if($this->request->isPost()){
            $query = Criteria::fromInput($this->di,'CnArea',$this->request->getPost());
            $this->persistent->param = $query->getParams();
        }else{

        }

        $searchList = CnArea::find($this->persistent->param);
        if(count($searchList)==0){

        }else{
            $paginator = new Phalcon\Paginator\Adapter\Model([
                'data' => $searchList,
                'limit'=>100,
                'page'=>1,
            ]);
            $page = $paginator->getPaginate();
            $this->view->page = $page;
        }

    }

}