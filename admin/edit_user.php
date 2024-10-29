<?php include("includes/header.php"); ?>
<?php include("includes/photo_library_modal.php"); ?>
<?php
    if(!$session->is_signed_in())
    {
        redirect('login.php');
    }



    //if id doesnt exist send the uer back to home page only existing user can access this page
    if(!isset($_GET['id']) || empty($_GET['id'])){

      redirect("users.php");
    }    
      $user = User::find_by_id($_GET['id']);
      $uObj = new User(); 
      $picture_path = $uObj->picture_path();

      if(isset($_POST['update'])){
       

        if($user){
          $user->username = $_POST['username'];
          $user->password = $_POST['password'];
          $user->first_name = $_POST['first_name'];
          $user->last_name = $_POST['last_name'];


          if(empty($_FILES['user_image'])){
            $user->save();
          }else{
            $user->set_file($_FILES['user_image']);
            $user->upload_photo();
            $user->save();

            redirect("edit_user.php?id={$user->id}");
          }
        }
      }
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
                        <h1 class="page-header">
                        User
                            <small>new user</small>
                            <small>SUbheading</small>
                        </h1>

                        <div class="col-md-6 user_image_box">
                          <a href="#" data-toggle="modal" data-target="#photo-library">
                          <img class="img-resposive" src="<?php echo $picture_path . $user->filename; ?>">               
                        </div>

                        <div class="col-md-6">
                          <form action="" method="POST" enctype="multipart/form-data">
                              
                              <div class="form-group">
                                <input type="file" name="user_image" id="user_image">
                              </div>
                              
                              <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control" value="<?php echo $user->username; ?>">
                              </div>
                              
                              <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" value="<?php echo $user->password; ?>">
                              </div>
                              
                              <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" id="first_name" class="form-control" value="<?php echo $user->first_name; ?>">
                              </div>
                              
                              <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" id="last_name" class="form-control" value="<?php echo $user->last_name ?>">
                              </div>
                              <div class="info-box-footer clearfix">
                                <div class="info-box-delete pull-left" style="padding-right: 15px;">
                                  <a  href="users.php" class="btn btn-secondary btn-lg ">Cancel</a>   
                                </div>
                                <div class="info-box-delete pull-left" style="padding-right: 15px;">
                                  <a id="user-id" href="delete_user.php?id=<?php echo $user->id; ?>" class="btn btn-danger btn-lg ">Delete</a>   
                                </div>
                                <div class="info-box-update">
                                  <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg">
                                </div>   
                              </div>  
                            </div> 
                          </form>
                        </div>
                </div>
            </div>
                <!-- /.row -->

        </div>
            <!-- /.container-fluid -->

      </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>
