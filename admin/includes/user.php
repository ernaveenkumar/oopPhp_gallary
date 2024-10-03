<?php

class User{


  public $id;
  public $username;
  public $password;
  public $first_name;
  public $last_name;

  public static function find_all_users(){

    global $database;
    $result_set = self::find_this_query("select * from users");
    //$result_set = $database->query("select * from users");
    return $result_set;
  }

  public static function find_user_by_id($user_id){
    global $database;
    $the_result_array = self::find_this_query("select * from users where id = $user_id Limit 1");

    return !empty($the_result_array) ? array_shift($the_result_array) : false;
   
  }

  public static function find_this_query($sql){
    global $database;

    $result_set = $database->query($sql);
    $the_object_array = array();
    while($row = mysqli_fetch_array($result_set)){

      $the_object_array[] =  self::instantation($row); 
    }
    
    return $the_object_array;
  }

  public static function instantation($the_record){

    $the_object = new self;
    
    // $the_object->id = $the_record['id'];
    // $the_object->username=$the_record['username'];
    // $the_object->password=$the_record['password'];
    // $the_object->first_name=$the_record['first_name'];
    // $the_object->last_name=$the_record['last_name'];

    foreach($the_record as $the_attribute => $value){

      if($the_object->has_the_attribute($the_attribute)){

        $the_object->$the_attribute = $value;
      }

    }

    return $the_object;
  }

  private function has_the_attribute($the_attribute){
    
    $object_properties = get_object_vars($this);
    return array_key_exists($the_attribute, $object_properties);
  }


}