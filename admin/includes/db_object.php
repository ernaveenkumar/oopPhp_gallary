<?php 

class Db_object{

  //protected static $db_table = "users";
  public $errors = array();
  // public $upload_errors_array = array(
  
  
  //   UPLOAD_ERR_OK           => "There is no error",
  //   UPLOAD_ERR_INI_SIZE		=> "The uploaded file exceeds the upload_max_filesize directive in php.ini",
  //   UPLOAD_ERR_FORM_SIZE    => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
  //   UPLOAD_ERR_PARTIAL      => "The uploaded file was only partially uploaded.",
  //   UPLOAD_ERR_NO_FILE      => "No file was uploaded.",               
  //   UPLOAD_ERR_NO_TMP_DIR   => "Missing a temporary folder.",
  //   UPLOAD_ERR_CANT_WRITE   => "Failed to write file to disk.",
  //   UPLOAD_ERR_EXTENSION    => "A PHP extension stopped the file upload."					
                          
  
  // );
  # Late static binding
  public static function find_all(){

    //global $database;
    $result_set = static::find_this_query("select * from ". static::$db_table . " ");
    //$result_set = $database->query("select * from users");
    return $result_set;
  }

  public static function find_by_id($id){
    //global $database;
    $the_result_array = static::find_this_query(" select * from ". static::$db_table ." where id = $id Limit 1");

    return !empty($the_result_array) ? array_shift($the_result_array) : false;
    
  }

  public static function find_this_query($sql){
    global $database;

    $result_set = $database->query($sql);
    $the_object_array = array();
    while($row = mysqli_fetch_array($result_set)){

      $the_object_array[] =  static::instantation($row); 
    }
    
    return $the_object_array;
  }

  public static function instantation($the_record){


    #instantiate the calling class
    $calling_class = get_called_class();
    $the_object = new $calling_class;
    //$the_object = new static;
    
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

  public function save(){
    return isset($this->id) ? $this->update() :$this->create();
  }

  public function create(){
    global $database;

    $properties = $this->clean_properties();

    
    $sql = "INSERT INTO ". static::$db_table ."( ". implode(",", array_keys($properties)) ." )";
    // $sql = "INSERT INTO ". static::$db_table ." (username, password, first_name, last_name)";
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


    $sql = "UPDATE ". static::$db_table ." SET ";
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

    $sql = "DELETE FROM ". static::$db_table ." WHERE ";
    $sql .= "id = ". $database->escape_string($this->id) ;
    $sql .= " LIMIT 1";

    $database->query($sql);
    return (mysqli_affected_rows($database->connection) == 1) ? true:false;
  }

  protected function clean_properties(){
    global $database;

    $clean_properties = array();
    foreach($this->propertise() as $key => $value){
      $clean_properties[$key] = $database->escape_string($value);
    }
    return $clean_properties;
  }

  protected function propertise(){
    
    $properties = array();
    //$object_properties = get_object_vars($this);
    foreach(static::$db_table_fields as $db_field){
      if(property_exists($this, $db_field)){
        $properties[$db_field] = $this->$db_field;
      }
    }
    return $properties;
  }


  public static function count_all(){

    global $database;
    $sql = "SELECT COUNT(*) FROM ". static::$db_table;
    $result_set = $database->query($sql);

    $row = mysqli_fetch_array($result_set);

    return array_shift($row);

  }

}