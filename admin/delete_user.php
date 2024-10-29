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
      redirect('users.php');
    }

    $user = User::find_by_id($_GET['id']);

    //var_dump($user);
    //die;
    
    if($user){
      $user->delete();
      redirect('users.php');
    }else{
      redirect('users.php');
    }
?>