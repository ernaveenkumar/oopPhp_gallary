<?php

class User extends Db_object{

  protected static $db_table = "users";
  protected static $db_table_fields = array ('username', 'password', 'first_name', 'last_name', 'filename');
  public $id;
  public $username;
  public $password;
  public $first_name;
  public $last_name;
  public $filename;
  public $upload_directory = "images";
  public $image_placeholder = "http://placehold.it/400x400&text=image";
  //public $image_placeholder = "https://placehold.co/200x200/000000/FFF";



//copied from photo.php file
public $upload_errors_array = array(


  UPLOAD_ERR_OK           => "There is no error",
  UPLOAD_ERR_INI_SIZE		=> "The uploaded file exceeds the upload_max_filesize directive in php.ini",
  UPLOAD_ERR_FORM_SIZE    => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
  UPLOAD_ERR_PARTIAL      => "The uploaded file was only partially uploaded.",
  UPLOAD_ERR_NO_FILE      => "No file was uploaded.",               
  UPLOAD_ERR_NO_TMP_DIR   => "Missing a temporary folder.",
  UPLOAD_ERR_CANT_WRITE   => "Failed to write file to disk.",
  UPLOAD_ERR_EXTENSION    => "A PHP extension stopped the file upload."	
);





 

  //set_file function copied from photo.php file and pasted here
  public function set_file($file){
  
    //Checking if file empty OR its not a file OR its not array
  if(empty($file) || !$file || !is_array($file)){

    $this->errors[] = "There was no file uploaded here";
    return false;

  }elseif($file['error'] != 0){

    $this->errors[] = $this->upload_errors_array[$file['error']];
    return false;
  }else{

    //If nothing is wrong then  save the information of image
    $this->filename = basename($file['name']);
    $this->tmp_path = $file['tmp_name'];
    $this->type = $file['type'];
    $this->size = $file['size'];
  }
}


//Save method is copied from photo.php file and pasted here
public function upload_photo(){


    if(!empty($this->errors)){
      return false;
    }
    if(empty($this->filename) || empty($this->tmp_path)){
      $this->errors[] = "The file was not available";
      return false;
    }

    $target_path = SITE_ROOT. DS . 'admin' . DS . $this->upload_directory . DS. $this->filename;
    //die($target_path);

    if(file_exists($target_path)){
      
      $this->errors[] = "=The file {$this->filename} already exists";
      return false;
    }

    if(move_uploaded_file($this->tmp_path, $target_path)){

      
        unset($this->tmp_path);
        return true;
     
    }else{
      $this->errors[] = "The folder directory probably does not have permission";
      return false;
    }

}

  public function picture_path(){
    $picture_path = $this->upload_directory. DS;
    return $picture_path;
  }


public function image_place_holder(){
   return $this->image_placeholder;
} 

public function image_path_and_placeholder(){

  $pPath = $this->picture_path();
  $iplaceHolder = $this->image_place_holder(); 
  return $pPath.$iplaceHolder;
}

public function user_image_path(){

  return $this->upload_directory. DS;
}

  public static function verify_user($username, $password){
    // database object
    global $database;
    $username = $database->escape_string($username);
    $password = $database->escape_string($password);

    //echo "user is ". $username. " pass is ". $password;
    //die();
   

    $sql = "SELECT * FROM ". static::$db_table ." WHERE ";
    $sql .= "username = '{$username}'";
    $sql .= "AND password = '{$password}'";
    $sql .= "LIMIT 1";
    
    $the_result_array = static::find_this_query($sql);
    return !empty($the_result_array)? array_shift($the_result_array):false;
    
  }


  public function ajax_save_user_image($user_image, $user_id){

    // $this->filename = $user_image;
    // $this->id = $user_id;
    // $this->save();
    global $database;

    $user_image = $database->escape_string($user_image);
    $user_id = $database->escape_string($user_id);

    $this->filename = $user_image;
    $this->id = $user_id;

    $sql = "UPDATE ". self::$db_table . " SET filename = '{$this->filename}'";
    $sql .= " WHERE id = '$this->id'";
    $database->query($sql);
  
    echo $this->picture_path() . $this->filename;



  }


}