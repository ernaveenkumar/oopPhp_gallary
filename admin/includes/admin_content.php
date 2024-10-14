<div class="container-fluid">

  <!-- Page Heading -->
  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">
          Admin
              <small>Subheading</small>
          </h1>

        <?php

          // $user = new User();
          // $user->username = "Student 2";
          // $user->password = "student2pass123";
          // $user->first_name = "student2_firstname";
          // $user->last_name = "student2_lastname";
          // $user->create();

          //Update
          // $user = User::find_user_by_id(5);
          // $user->username = "David145";
          // $user->password = "david1989";
          // $user->first_name = "David";
          // $user->last_name = "Wiiliams";
          // $user->save();

          //Delete a user
          //$user = User::find_user_by_id(3);
          //$user->delete();

        ?>




        <?php 
          $users = User::find_all();
          foreach($users as $user){
            echo $user->username; 
          }
        ?>

        <?php
            echo "-----------------";
            $found_user = User::find_by_id(1);
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
          $photo = new Photo();
          $photo->photo_title = "Photo 2";
          $photo->photo_description = "Photo Desc";
          $photo->create();
        ?>

        <?php 
          $photos = Photo::find_all();
          foreach($photos as $photo){
            echo $photo->photo_title; 
          }
        ?>

          <?php

            //$picture = new Picture(); //check the role of autoloading
          ?>
      </div>
  </div>
  <!-- /.row -->
</div>
<!-- /.container-fluid -->