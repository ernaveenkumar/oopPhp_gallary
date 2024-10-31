<?php include("includes/header.php"); ?>


<?php
    if(!$session->is_signed_in())
    {
        redirect('login.php');
    }




    //$comments = Comment::find_all();
    if(isset($_GET['id'])){
      $photoId = $_GET['id'];
      $comments = Comment::find_the_comments($photoId);
    }else{
      $comments = Comment::find_the_comments(); //[]
    }
   
    // $uObj = new User(); 
    // $user_image_path = $uObj->picture_path();
    // $user_image_placeholder = $uObj->image_place_holder();
    //die($user_image_path);
?>
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">SB Admin</a>
            </div>
            <!-- Top Menu Items -->
            <?php include("includes/top_nav.php") ?>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <?php include("includes/side_nav.php"); ?>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
       
                        <p class="bg-success"><?php echo $session->message; ?></p>
                        <div class="col-md-12">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Comment Id</th>
                                        <th>Photo Id</th>
                                        <th>Author</th>
                                        <th>description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    
                                    if (empty($comments)) {
                                        echo "<tr><td>No comment found</td></tr>";
                                    } else{

                                    
                                    foreach($comments as $comment) :?>
                                        <!-- https://place-hold.it/62x62 -->
                                    <tr>
                                        <td>
                                          
                                                <div class="action_links">
                                                <a href="delete_comment.php?id=<?php echo $comment->id; ?>">Delete</a>
                                                <a href="edit_comment.php?id=<?php echo $comment->id; ?>">Edit</a>
                                                <a href="comment.php?id=<?php echo $comment->photo_id ?>">View</a>
                                            </div>

                                        </td>
                                        
                                        <td><?php echo $comment->id; ?></td>
                                        <td><?php echo $comment->photo_id; ?></td>
                                        <td><?php echo $comment->author; ?></td>
                                        <td><?php echo $comment->body; ?></td>
                                       
                                    </tr>
                                    <?php endforeach; }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>