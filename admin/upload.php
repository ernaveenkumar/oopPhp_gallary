<?php include("includes/header.php"); ?>
<?php
    if(!$session->is_signed_in())
    {
        redirect('login.php');
    }

    if(isset($_POST['submit'])){        
     
        $photo = new Photo();
        $photo->photo_title = $_POST['title'];
        $photo->set_file($_FILES['file_upload']);

        if($photo->save()){
            $message = "Photo uploaded";
        }else{
            $message = join("<br />", $photo->errors);
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
                          UPLOAD
                            <small></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">UPLOAD</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file">UPLOAD</i> 

                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <col class="col-md-6">
                        <form action="upload.php" enctype="multipart/form-data" method="post" >
                            <input type="text" name="title" id="title" class="form-control">
                            <br />
                            <br />
                            <input type ="file" name="file_upload"> <br /><br />
                            <input type="submit" name="submit">
                        </form>
                        <br />
                        <h2><?php isset($the_message) ? $the_message : "" ?></h2>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>