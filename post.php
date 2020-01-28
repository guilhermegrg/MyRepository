<?php include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>

  
<?php


if(isset($_GET['id'])){
    $id = $_GET['id'];
    
    $query = "UPDATE posts SET views = views + 1 WHERE id=$id";
    $result = query($query);
    
    
    
    if(isset($_SESSION['role'])){
        $role = $_SESSION['role'];
        if($role == 'admin'){
            $published_query =  "";
        }else{
                $published_query =  " AND status='published'";
        }
    }else{
        $published_query =  " AND status='published'";
    }
    
    
    $query = "SELECT * FROM posts WHERE id=$id $published_query";
                              
    $posts = query($query);
    $row = mysqli_fetch_assoc($posts);                  

    if(mysqli_num_rows($posts) == 0){
        echo "<h2>No posts!</h2>";
        header("Location: index.php");
    }else{
    

        $author_id = $row['author_id'];
        $title = $row['title'];
        $cat_id = $row['cat_id'];
        $status = $row['status'];
        $image = $row['image'];
        $tags = $row['tags'];
        $content = $row['content'];
        $comment_count = $row['comment_count'];
        $date = $row['date'];




        if(!$author_id){
            $author_name = "NOT DEFINED";
        }else{
            $query = "SELECT * FROM users WHERE id=$author_id";
            $results = query($query);
            $row = mysqli_fetch_assoc($results);

            $author_name = $row['username'];
        }

    }

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
                <?php if($author_id){ ?>
                <p class="lead">
                    by <a href="/cms/author/<?php echo $author_id; ?>"><?php echo $author_name; ?></a>
                </p>
                <?php } ?>
               
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
                
                <?php if(!isset($image) || empty($image)): ?> 
                    <img class="img-responsive" src="/cms/images/CF_Hierarchy_new1.png" alt="">
                <?php else: ?>
                    <img class="img-responsive" src="/cms/images/<?php echo $image; ?>" alt="">                
                <?php endif; ?>
                
                
                

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
