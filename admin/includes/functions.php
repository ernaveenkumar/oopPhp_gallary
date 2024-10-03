<?php
spl_autoload_register(function($class) {
  $class = strtolower($class);
  $the_path = "includes/{$class}.php";

  if(file_exists($the_path) && !class_exists($class)){
    require_once($the_path);
  }else{
    die("This file name {$class}.php was not man");
  }
});