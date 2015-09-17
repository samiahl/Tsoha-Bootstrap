<?php
/**
 * Created by PhpStorm.
 * User: samiahl
 * Date: 17.9.2015
 * Time: 11:46
 */
class Writer extends BaseModel{

    public $writer_id,$writer_name, $book_id, $publisher_id;

    public function __construct($attributes){
        parent::__construct($attributes);
    }
}