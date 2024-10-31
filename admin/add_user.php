<?php include("includes/header.php"); ?>
<?php
    if(!$session->is_signed_in())
    {
        redirect('login.php');
    }




      //$photo = Photo::find_by_id($_GET['id']);
      //$pObj = new Photo(); 
      //$picture_path = $pObj->picture_path();

      $user = new User();

      if(isset($_POST['create'])){
       

        if($user){
          $user->username = $_POST['username'];
          $user->password = $_POST['password'];
          $user->first_name = $_POST['first_name'];
          $user->last_name = $_POST['last_name'];
          $user->set_file($_FILES['user_image']);
          $user->create();
          $user->upload_photo();
          $session->message("User {$user->first_name} {$user->last_name} has been added.");
          redirect("users.php");
        }
      }


   
    // $photos = Photo::find_all();
    // $pObj = new Photo(); 
    // $picture_path = $pObj->picture_path();
    

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
                        </h1>

                        <form action="" method="POST" enctype="multipart/form-data">
                        <div class="col-md-6 col-md-offset-3">

                          <div class="form-group">
                            <input type="file" name="user_image" id="">
                          </div>
                          
                          <div class="form-group">
                          <label for="username">Username</label>
                            <input type="text" name="username" id="" class="form-control">
                          </div>

                          <div class="form-group">
                          <label for="password">Password</label>
                            <input type="password" name="password" id="" class="form-control">
                          </div>

                          <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" id="" class="form-control">
                          </div>

                          <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" id="" class="form-control">
                          </div>
                          <div class="info-box-footer clearfix">
                                  <div class="info-box-delete pull-left" style="padding-right: 15px;">
                                      <a  href="users.php" class="btn btn-danger btn-lg ">Cancel</a>   
                                  </div>
                                  <div class="info-box-update">
                                      <input type="submit" name="create" value="Save" class="btn btn-primary btn-lg">
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