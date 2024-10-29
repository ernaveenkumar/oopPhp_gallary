<?php

class Comment extends Db_object{

  protected static $db_table = "comments";
  protected static $db_table_fields = array ('id','photo_id', 'author', 'body');
  public $id;
  public $photo_id;
  public $author;
  public $body;



  public static function create_comment($photo_id, $author ="John", $body ="Doe"){

    if(!empty($photo_id) && !empty($author) && !empty($body)){

      $comment = new Comment();

      $comment->photo_id = (int)$photo_id;
      $comment->author = $author;
      $comment->body = $body;

      return $comment;
    }else{
      return false;
    }
  }


  public static function find_the_comments($photo_id=0){

    global $database;

    $sql = " SELECT * FROM ". self::$db_table;

    if($photo_id != 0){
      $sql .= " WHERE photo_id = ". (int)$database->escape_string($photo_id);
    }
    
    $sql .= " ORDER BY id DESC";

    return self::find_this_query($sql);
  }



}

