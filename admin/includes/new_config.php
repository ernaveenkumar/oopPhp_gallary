<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS','');
define('DB_NAME', 'udemy_edwin_gallery_db');

$connection = mysqli_connect(DB_HOST,DB_USER, DB_PASS, DB_NAME);

//to check conenction hit http://localhost/PHP2024/section3/gallery/admin/includes/config.php
if($connection){ 
  echo "true";
}