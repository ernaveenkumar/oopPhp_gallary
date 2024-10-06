<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
        Admin
            <small>Subheading</small>
        </h1>
        <?php 
          $users = User::find_all_users();
          foreach($users as $user){
            echo $user->username; 
          }
        ?>


        <?php
            echo "-----------------";
            $found_user = User::find_user_by_id(1);
            $user = User::instantation($found_user);

            //echo $found_user['username'];
            // $user = new User();
            // $user->id = $found_user['id'];
            // $user->username=$found_user['username'];
            // $user->password=$found_user['password'];
            // $user->first_name=$found_user['first_name'];
            // $user->last_name=$found_user['last_name'];

            echo $user->username;
        ?>

        <?php

          //$picture = new Picture(); //check the role of autoloading
        ?>

     



    </div>
</div>
<!-- /.row -->
</div>
<!-- /.container-fluid -->