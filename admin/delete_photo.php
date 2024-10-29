<?php include("includes/init.php"); ?>
<?php
    if(!$session->is_signed_in())
    {
        redirect('login.php');
    }
?>

<?php


    if(empty($_GET['id'])){
      //die('Here you are');
      redirect('photos.php');
    }

    $photo = Photo::find_by_id($_GET['id']);

    //var_dump($photo);
    //die;
    
    if($photo){
      $photo->delete_photo();
      redirect('../photos.php');
    }else{
      redirect('../photos.php');
    }
?>