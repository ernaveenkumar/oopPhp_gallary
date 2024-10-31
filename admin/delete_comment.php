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
      redirect('comments.php');
    }

    $comment = Comment::find_by_id($_GET['id']);

    //var_dump($user);
    //die;
    
    if($comment){
      
      $comment->delete();
      $session->message("The comment  with {$comment->id} has been deleted.");
      redirect("comments.php?id={$comment->photo_id}");
    }else{
      redirect("comments.php?id={$comment->photo_id}");
    }
?>