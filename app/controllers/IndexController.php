<?php
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $this->view->disable();
        /*
        $good = Goods::findFirst(1);
        $good->name="ttdsad";
        $good->save();
        */
        $currentPage = $this->request->get('page');

        $datasource = Goods::find();
        $pagination = new PaginatorModel([
            "data"  => $datasource,
            "limit" => 1,
            "page"  => $currentPage,
        ]
        );
        $page = $pagination->getPaginate();
        $this->view->page=$page;
        //print_r($page);
        //$this->view->disable();
        //print_r($pagination);
        $this->view->disable();
    }

}

