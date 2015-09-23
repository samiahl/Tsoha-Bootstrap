<?php
/**
 * Created by PhpStorm.
 * User: samiahl
 * Date: 17.9.2015
 * Time: 11:46
 */
class Writer extends BaseModel{

    public $id,$writer_name;

    public function __construct($attributes){
        parent::__construct($attributes);
    }

    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Writer');
        $query->execute();

        $rows = $query->fetchAll();
        $writers = array();

        foreach($rows as $row){
            $writers[] = new Writer(array(
                'id' => $row['id'],
                'writer_name' => $row['writer_name'],
            ));

        }
        return $writers;
    }

    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Writer WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if($row){
            $writer = new Writer(array(
                'id' => $row['id'],
                'writer_name' => $row['writer_name'],
            ));
            return $writer;
        }
        return null;
    }
}