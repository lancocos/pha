<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/29
 * Time: 11:25
 */
use Phalcon\Forms\Element\Text;
class AreaForm extends \Phalcon\Forms\Form
{
    public function initialize($entry  = null, $options = []){
        $id = new Text('id');
        $id->setLabel('id');
        $this->add($id);

        $level = new Text('level');
        $level->setLabel('level');
        $this->add($level);

        $name = new Text('name');
        $name->setLabel('name');
        $this->add($name);
    }
}