<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/4
 * Time: 13:42
 */

class MyPaginator implements \Phalcon\Paginator\AdapterInterface
{

    public function setCurrentPage($page)
    {
        // TODO: Implement setCurrentPage() method.
        $this->page = $page;


    }

    public function getPaginate()
    {
        // TODO: Implement getPaginate() method.
    }

    public function setLimit($limit)
    {
        // TODO: Implement setLimit() method.
    }

    public function getLimit()
    {
        // TODO: Implement getLimit() method.
    }
}