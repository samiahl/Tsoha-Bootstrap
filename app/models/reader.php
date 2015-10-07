<?php
/**
 * Created by PhpStorm.
 * User: samiahl
 * Date: 17.9.2015
 * Time: 13:08
 */
class Reader extends BaseModel{

    public $id, $reader_name, $reader_password;

    public function __construct($attributes){
        parent::__construct($attributes);
    }

    public static function authenticate($reader_name, $reader_password){
        $query = DB::connection()->prepare('SELECT * FROM Reader WHERE reader_name = :username AND reader_password = :password LIMIT 1');
        $query->execute(array(':username' => $reader_name, ':password' => $reader_password));
        $row = $query->fetch();
        if($row){
            $reader = new Reader(array(
                'id' => $row['id'],
                'reader_name' => $row['reader_name'],
                'reader_password' => $row['reader_username']
            ));
            return $reader;
        }else{
            return null;
        }
    }

    public static function find($reader_id){


    }
}