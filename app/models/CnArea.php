<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/4
 * Time: 9:43
 */

class CnArea extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $level;

    /**
     *
     * @var integer
     */
    public $parent_code;

    /**
     *
     * @var integer
     */
    public $area_code;

    /**
     *
     * @var integer
     */
    public $zip_code;

    /**
     *
     * @var string
     */
    public $city_code;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $short_name;

    /**
     *
     * @var string
     */
    public $merger_name;

    /**
     *
     * @var string
     */
    public $pinyin;

    /**
     *
     * @var double
     */
    public $lng;

    /**
     *
     * @var double
     */
    public $lat;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("test");
        $this->setSource("cnarea_2018");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'cnarea_2018';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Cnarea2018[]|Cnarea2018|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Cnarea2018|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
