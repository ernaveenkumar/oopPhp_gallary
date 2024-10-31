<?php include("includes/header.php"); ?>


<?php
    if(!$session->is_signed_in())
    {
        redirect('login.php');
    }




    $users = User::find_all();
    //$uObj = new User(); 
    $user_image_path = User::picture_path();
    $user_image_placeholder = User::image_place_holder();
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
                        <p class="bg-success">
                            <?php echo $session->message; ?>
                            <?php echo "kil". $session->message(); ?>
                        </p>
                        <h1 class="page-header">
                        Users
                            <small><a href="add_user.php" class="btn btn-primary"> add user</a></small>
                        </h1>

                        <div class="col-md-12">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Photo</th>
                                        <th>Username</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    
                                    if (empty($users)) {
                                        echo "<tr><td>No user found</td></tr>";
                                    } else{

                                    
                                    foreach($users as $user) :?>
                                        <!-- https://place-hold.it/62x62 -->
                                    <tr>
                                        <td>
                                          
                                            <img src="<?php echo 
                                            
                                                empty($user->filename) ? $user_image_placeholder : $user_image_path.$user->filename; 
                                            
                                            ?>" alt="Title missing" class="admin-user-thumbnail user_image">
                                            <div class="action_links">
                                                <a href="delete_user.php?id=<?php echo $user->id; ?>">Delete</a>
                                                <a href="edit_user.php?id=<?php echo $user->id; ?>">Edit</a>
                                                <a href="#">View</a>
                                            </div>

                                        </td>
                                        <td><?php echo $user->id; ?></td>
                                        <td><?php echo $user->username; ?></td>
                                        <td><?php echo $user->first_name; ?></td>
                                        <td><?php echo $user->last_name; ?></td>
                                        <!-- <td><?php echo $user->size; ?></td> -->
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