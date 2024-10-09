<?php

class User{

  protected static $table_name = "users";
  protected static $db_table_fields = array ('username', 'password', 'first_name', 'last_name');
  public $id;
  public $username;
  public $password;
  public $first_name;
  public $last_name;

  public static function find_all_users(){

    //global $database;
    $result_set = self::find_this_query("select * from ". self::$table_name);
    //$result_set = $database->query("select * from users");
    return $result_set;
  }

  public static function find_user_by_id($user_id){
    //global $database;
    $the_result_array = self::find_this_query(" select * from ". self::$table_name ." where id = $user_id Limit 1");

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

  public static function verify_user($username, $password){
    // database object
    global $database;
    $username = $database->escape_string($username);
    $password = $database->escape_string($password);

    //echo "user is ". $username. " pass is ". $password;
    //die();
   

    $sql = "SELECT * FROM ". self::$table_name ." WHERE ";
    $sql .= "username = '{$username}'";
    $sql .= "AND password = '{$password}'";
    $sql .= "LIMIT 1";
    
    $the_result_array = self::find_this_query($sql);
    return !empty($the_result_array)? array_shift($the_result_array):false;
    
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

  protected function propertise(){
    
    $properties = array();
    //$object_properties = get_object_vars($this);
    foreach(self::$db_table_fields as $db_field){
      if(property_exists($this, $db_field)){
        $properties[$db_field] = $this->$db_field;
      }
    }
    return $properties;
  }

  protected function clean_properties(){
    global $database;

    $clean_properties = array();
    foreach($this->propertise() as $key => $value){
      $clean_properties[$key] = $database->escape_string($value);
    }
    return $clean_properties;
  }

  public function save(){
    return isset($this->id) ? $this->update() :$this->create();
  }

  public function create(){
    global $database;

    $properties = $this->clean_properties();

    
    $sql = "INSERT INTO ". self::$table_name ."( ". implode(",", array_keys($properties)) ." )";
    // $sql = "INSERT INTO ". self::$table_name ." (username, password, first_name, last_name)";
    $sql .= "VALUES('".  implode("','", array_values($properties))  ."')";
    //$sql .= "VALUES('";
    // $sql .= $database->escape_string($this->username). "','";
    // $sql .= $database->escape_string($this->password). "','";
    // $sql .= $database->escape_string($this->first_name)."','";
    // $sql .= $database->escape_string($this->last_name). "')";
    
    if($database->query($sql)){
      $this->id = $database->the_insert_id();
      return true;
    }else{
      return false;
    }
  }

  public function update(){
    global $database;


    $properties_pairs = array();
    $properties = $this->clean_properties();

    foreach($properties as $key =>$value){
      $properties_pairs [] = "{$key} ='{$value}'";
    }


    $sql = "UPDATE ". self::$table_name ." SET ";
    $sql .= implode(', ', $properties_pairs);
    // $sql .= "username= '".   $database->escape_string($this->username) ."',";
    // $sql .= "password= '".   $database->escape_string($this->password) ."',";
    // $sql .= "first_name= '". $database->escape_string($this->first_name) ."',";
    // $sql .= "last_name= '".  $database->escape_string($this->last_name) ."'";
    $sql .= " WHERE id = '". $database->escape_string($this->id) ."'";

    $database->query($sql);

    return (mysqli_affected_rows($database->connection) == 1) ? true : false;
  }

  public function delete(){
    global $database;

    $sql = "DELETE FROM ". self::$table_name ." WHERE ";
    $sql .= "id = ". $database->escape_string($this->id) ;
    $sql .= " LIMIT 1";

    $database->query($sql);
    return (mysqli_affected_rows($database->connection) == 1) ? true:false;
  }


}