<?php
require_once ('new_config.php');
class Database {

  public function __construct(){
    $this->open_db_connection();
  }

  public $connection;
  public function open_db_connection(){

    // $this->connection = mysqli_connect(
    //   DB_HOST,
    //   DB_USER, 
    //   DB_PASS, 
    //   DB_NAME);

      $this->connection = new mysqli(
        DB_HOST,
        DB_USER, 
        DB_PASS, 
        DB_NAME);

      // if(mysqli_connect_errno()){
      //   die('Database connection failed');
      // }
      if($this->connection->connect_error){
        die('Database connection failed'. $this->connection->connect_error);
      }
     
     
  }

   //Perform query
  public function query($sql){
    //$result = mysqli_query($this->connection, $sql);
    $result = $this->connection->query($sql);
    $this->confirm_query($result);
    return $result;
  }

  private function confirm_query($result){

    if(!$result){
      die('Qyery Failed!');
    }
  }

  public function escape_string($string){
    // $escaped_string = mysqli_real_escape_string($this->connection, $string);
    $escaped_string = $this->connection->real_escape_string($string);
    return $escaped_string;
  }

}

$database = new Database();
