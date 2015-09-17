<?php
/**
 * Created by PhpStorm.
 * User: samiahl
 * Date: 17.9.2015
 * Time: 14:10
 */
class Library extends BaseModel{

    public $library_id, $user_id;

    public function __construct($attributes){
        parent::__construct($attributes);
    }
}