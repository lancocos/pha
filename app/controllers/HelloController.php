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

    public function dbAction(){
        $id = $this->request->get('id','int');
        $sql = "select * from goods where id = ?";
        $param = [$id];
        $stmt = $this->db->query($sql,$param);
        $goods = $stmt->fetchAll(Phalcon\Db::FETCH_OBJ);
        var_dump($goods);
        foreach ($goods AS $good){
           echo $good->name.$good->created_at;
           echo "<br/>";
        }
        $this->view->disable();
    }

    public function findAction(){
        $good = Goods::findFirst(3);
        print_r($good);
        $this->view->disable();
    }

}

