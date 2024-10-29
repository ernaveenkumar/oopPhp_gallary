<?php include("includes/header.php"); ?>

<?php 

    if(empty($_GET['id'])){

        redirect("index.php");
    }

    $photo = Photo::find_by_id($_GET['id']);

    if(isset($_POST['submit'])){
        
        
        $author = $_POST['author'];
        $body = $_POST['body'];

        $new_comment = Comment::create_comment($photo->id, $author, $body);

        if($new_comment &&  $new_comment->save()){

            redirect("comments.php?id=".$photo->id);
        }else{

            $message = "There was some problems saving";
        }
        
    }else{

        $author = "";
        $body = "";
    }

    $comments = Comment::find_the_comments($photo->id);

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
                        COMMENTS
                            <small>Subheading</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="comments.php">COMMENTS</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> COMMENTS
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-md-12 col-lg-offset-5">
                        <h3><?php echo $photo->title; ?></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-md-offset-5">
                    <img src="<?php echo $picture_path.$photo->filename; ?>" alt="">
                    </div>                    
                </div>
                <div class="row">
                <div class="col-md-12">
                        
                        <p><?php echo $photo->description; ?></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">


                        <!-- comment form -->

                        <div class="well">
                                        <h4><b> Leave a Comment:</b></h4>
                                            <form role="form" method="post">
                                                <div class="form-group">
                                                    <label for="author">Author</label>
                                                    <input type="text" name="author" id="">
                                                </div>
                                               
                                                <div class="form-group">
                                                    <textarea name="body" class ="form-control" id="" cols="30" rows="10"></textarea>
                                                </div>
                                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                            </form>
                        </div>
                        <hr />
                            <!-- Posted Comment -->

                        <?php foreach($comments as $comment): ?>

                            <div class="media">
                                <a href="#" class="pull-left">
                                    <img src="https://placehold.co/600x400?text=Hello+World" alt="" class="media-object user_image">
                                </a>
                                        <div class="media-body">
                                           
                                            <h4 class="media-heading">
                                                 <?php echo $comment->author; ?>
                                                <small>August 25. 2014 at 9:30 PM</small>
                                            </h4>
                                        <?php echo $comment->body; ?>
                                        </div>
                                    </img>
                            </div>

                        <?php endforeach;?>




                            <!-- Comment -->


                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>