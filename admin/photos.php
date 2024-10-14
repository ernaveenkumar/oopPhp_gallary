<?php include("includes/header.php"); ?>
<?php
    if(!$session->is_signed_in())
    {
        redirect('login.php');
    }

    $photos = Photo::find_all();
    $pObj = new Photo(); 
    $picture_path = $pObj->picture_path();
    

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
                        PHOTOS
                            <small>Subheading</small>
                        </h1>

                        <div class="col-md-12">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Photo</th>
                                        <th>Id</th>
                                        <th>File Name</th>
                                        <th>Title</th>
                                        <th>Size</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($photos as $photo) :?>
                                        <!-- https://place-hold.it/62x62 -->
                                    <tr>
                                        <td>
                                          
                                            <img src="<?php echo $picture_path.$photo->filename; ?>" alt="Title missing">
                                        </td>
                                        <td><?php echo $photo->photo_id; ?></td>
                                        <td><?php echo $photo->filename; ?></td>
                                        <td><?php echo $photo->photo_title; ?></td>
                                        <td><?php echo $photo->size; ?></td>
                                    </tr>
                                    <?php endforeach;?>
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