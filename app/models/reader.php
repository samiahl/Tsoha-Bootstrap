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

    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Reader');
        $query->execute();
        $rows = $query->fetchAll();
        $readers = array();

        foreach ($rows as $row){
            $readers = new Reader(array(
                'id' => $row['id'],
                'reader_name' => $row['reader_name'],
                'reader_password' => $row['reader_password']
            ));
        }
        return $readers;
    }

    public static function authenticate($username, $password){
        $query = DB::connection()->prepare('SELECT * FROM Reader WHERE reader_name = :username AND reader_password = :password LIMIT 1');
        $query->execute(array(':username' => $username, ':password' => $password));
        $row = $query->fetch();
        if($row){
            $reader = new Reader(array(
                'id' => $row['id'],
                'reader_name' => $row['reader_name'],
                'reader_password' => $row['reader_password']
            ));
            return $reader;
        }else{
            return null;
        }
    }

    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Reader WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if($row){
            $reader = new Reader(array(
               'id' => $row['id'],
                'reader_name' => $row['reader_name'],
                'reader_password' => $row['reader_password']
            ));
            return $reader;
        }else{
            return null;
        }
    }

    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Reader (reader_name, reader_password)
                                            VALUES (:reader_name, :reader_password) RETURNING id');
        $query->execute(array('reader_name' => $this->reader_name, 'reader_password' => $this->reader_password));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function update(){
        $query = DB::connection()->prepare('UPDATE Reader SET reader_name = :reader_name,
                                                              reader_password = :reader_password
                                                              WHERE id = :id');
        $query->execute(array(
            'id' => $this->id,
            'reader_name' => $this->reader_name,
            'reader_password' => $this->reader_password
        ));
        $row = $query->fetch();
    }
}