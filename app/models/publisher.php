<?php
/**
 * Created by PhpStorm.
 * User: samiahl
 * Date: 17.9.2015
 * Time: 11:46
 */
class Publisher extends BaseModel{

    public $id, $publisher_name;

    public function __construct($attributes){
        parent::__construct($attributes);
    }

    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Publisher');
        $query->execute();

        $rows = $query->fetchAll();
        $publishers = array();

        foreach($rows as $row){
            $publishers[] = new Publisher(array(
                'id' => $row['id'],
                'publisher_name' => $row['publisher_name'],
            ));

        }
        return $publishers;
    }

    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Publisher WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if($row){
            $publisher = new Publisher(array(
                'id' => $row['id'],
                'publisher_name' => $row['publisher_name'],
            ));
            return $publisher;
        }
        return null;
    }
}