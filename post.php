<?php include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>

  
<?php


if(isset($_GET['id'])){
    $id = $_GET['id'];
    
    $query = "SELECT * FROM posts WHERE id=$id";
                              
    $posts = query($query);
    $row = mysqli_fetch_assoc($posts);                  


    $author = $row['author'];
    $title = $row['title'];
    $cat_id = $row['cat_id'];
    $status = $row['status'];
    $image = $row['image'];
    $tags = $row['tags'];
    $content = $row['content'];
    $comment_count = $row['comment_count'];
    $date = $row['date'];
}


?>
    

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo $title; ?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#"><?php echo $author; ?></a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $date; ?></p>

               
               <?php

                    if(isset($_SESSION['role']))
                       {
                           $role = $_SESSION['role'];
                           if($role == 'admin'){
                               
                               ?>
                               
                            <p class="lead"><a href="admin/posts.php?source=edit_post&id=<?php echo $id; ?>">Edit Post</a></p>
                               
                               
                               <?php
            
                            }
                       }

                ?>
               
                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="images/<?php echo $image; ?>" alt="">

                <hr>

                <!-- Post Content -->
                <p class="lead"><?php echo $content; ?></p>

                <hr>

                <!-- Blog Comments -->

                

               <?php include "includes/comments.php"; ?>
               
            </div>
            <!-- Blog Sidebar Widgets Column -->
          <?php include "includes/sidebar.php"; ?>  
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php"; ?>
