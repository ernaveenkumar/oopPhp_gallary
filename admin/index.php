<?php include("includes/header.php"); ?>
<?php 

$page = !empty($_GET['page']) ? $_GET['page'] : 1;
$items_per_page = 4;

$items_total_count = Photo::count_all();

$paginate = new Paginate($page, $items_per_page, $items_total_count);

$sql = "SELECT * FROM photos ";
$sql .= "LIMIT {$items_per_page} ";
$sql .= "OFFSET {$paginate->offset()}";

$photos = Photo::find_this_query($sql); ?>

<?php   
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
                <a class="navbar-brand" href="index.html">Admin</a>
            </div>
            <!-- Top Menu Items -->
<?php include('includes/top_nav.php'); ?>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<?php include('includes/side_nav.php'); ?>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                            Dashboard
                                <small></small>
                            </h1>
                            </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="thumbnails row">
                    <?php foreach($photos as $photo): ?>

                            <div class="col-xs-6 col-md-3">
                                <a href="comment.php?id=<?php echo $photo->id; ?>" class="img-thumbnail">
                                    <img src="<?php echo $picture_path.$photo->filename?>" alt="" class="img-fluid home_page_photo">
                                </a>
                            </div>

                            <?php endforeach;?>
                        </div>
                        <nav aria-label="navigation">
                            <ul class="pagination justify-content-center">
                                <?php if($paginate->page_total() >1):?>

                                    <?php if($paginate->has_next()): ?>
                                        <li class="page-item">
                                            <a  class="page-link" href="index.php?page=<?php echo $paginate->next()?>">Next</a>
                                        </li>
                                    <?php endif; ?>
                                        
                                    <?php for($i =1 ; $i<= $paginate->page_total(); $i++):?>
                                
                                        <li class="page-item">
                                            <a class="page-link" href="index.php?page=<?php echo $i; ?>">
                                                <?php echo $i; ?>
                                            </a>
                                        </li>
                                    <?php endfor; ?>
                                                
                                    <?php if($paginate->has_previous()): ?>

                                        <li class="page-item">
                                            <a class="page-link" href="index.php?=<?php echo $paginate->previous(); ?>" >Previous</a>
                                        </li>
                                    <?php endif;?>
                                <?php endif; ?>
                            </ul>
                        </nav>
                        
                </div>
            </div>


            <?php include('includes/admin_content.php'); ?>
                        <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>