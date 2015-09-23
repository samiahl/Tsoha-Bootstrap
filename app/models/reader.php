<?php
/**
 * Created by PhpStorm.
 * User: samiahl
 * Date: 17.9.2015
 * Time: 13:08
 */
class Reader extends BaseModel{

    public $id, $reader_name;

    public function __construct($attributes){
        parent::__construct($attributes);
    }
}