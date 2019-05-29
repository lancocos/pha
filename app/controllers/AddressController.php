<?php
use Phalcon\Paginator\Adapter\Model AS ModelPaginator;
use Phalcon\Paginator\Adapter\QueryBuilder AS BuilderPaginator;
use Phalcon\Paginator\Adapter\NativeArray AS ArrayPaginator;

class AddressController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {

        $this->zbb1->write();
        $this->zbb1->read();

        $this->view->disable();
        exit;
        $currentPage = isset($_GET["page"])?(int) $_GET["page"]:1;

        //$data = CnArea::find();
        $builder = $this->modelsManager->createBuilder()
            ->columns("id, name")
            ->from("CnArea")
            ->orderBy("id DESC");
        $paginator = new BuilderPaginator([
            'builder'=>$builder,
            'limit'=>1,
            'page'=>$currentPage
        ]);
        $page = $paginator->getPaginate();
        //print_r($page);
        //$this->view->disable();
        //var_dump($page);
       // $this->view->disable();
        $this->view->setVar('page',$page);
    }

    public function page1Action(){
        $currentPage = isset($_GET["page"])?(int) $_GET["page"]:1;
        $data = [
            ['id'=>1,'name'=>"111"],
            ['id'=>2,'name'=>"222"],
            ['id'=>3,'name'=>"333"],
        ];
        $paginator = new ArrayPaginator([
           'data'=>$data,
            'limit'=>1,
            'page'=>$currentPage
        ]);
        $page = $paginator->getPaginate();
        $this->view->setVar('page',$page);
    }

    public function page2Action(){
        $currentPage = isset($_GET["page"])?(int) $_GET["page"]:1;

        $paginator = ModelPaginator([
            'data'=>Goods::find(),
            'limit'=>1,
            'page'=>$currentPage
        ]);
        $page = $paginator->getPaginate();
        $this->view->setVar('page',$page);
    }
    public function page3Action(){
        $currentPage = isset($_GET["page"])?(int) $_GET["page"]:1;
        $paginator = new MyPaginator([
            'data'=>[],
            'limit'=>1,
            'page'=>$currentPage,
        ]);
        $page = $paginator->getPaginate();
        var_dump($page);
        $this->view->disable();
        
    }

}

