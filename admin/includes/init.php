<?php


defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
defined('SITE_ROOT') ? null : define('SITE_ROOT',  'C:'.DS.'xampp'.DS.'htdocs'.DS.'PHP2024'.DS.'Edwin'. DS. 'section3'.DS.'oop_gallary');
defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH', SITE_ROOT.DS.'admin'.DS.'includes');



//C:\xampp\htdocs\PHP2024\Edwin\section3\oop_gallary>




require_once("functions.php");
require_once('new_config.php');
require_once('database.php');
require_once('db_object.php');
require_once('photo.php');
require_once('user.php');
require_once('session.php');