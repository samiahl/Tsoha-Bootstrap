<?php
/**
 * Created by PhpStorm.
 * User: samiahl
 * Date: 17.9.2015
 * Time: 11:46
 */
class Publisher extends BaseModel{

    public $publisher_id, $publisher_name;

    public function __construct($attributes){
        parent::__construct($attributes);
    }
}