<?php include "includes/header.php" ?>
   
   
    <!-- Navigation -->
    <?php include "includes/navigation.php" ?>
    
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
            


<?php
                    $posts_per_page = 3;
    
                    $page = 1;
                    if(isset($_GET['page'])){
                        $page=$_GET['page'];
                        if($page<1)
                            $page=1;
                    }
    
    


                    if(isset($_SESSION['role'])){
                        $role = $_SESSION['role'];
                        if($role == 'admin')
                        {
                            $published_query =  "";
                        }else{
                            $published_query =  " WHERE status='published'";
                        }
                    }else{
                        $published_query =  " WHERE status='published'";
                    }
                        


                    $query ="SELECT * FROM posts $published_query";
                    $posts = query($query);
                    $post_count = mysqli_num_rows($posts);
                    $page_count = ceil($post_count/$posts_per_page);
    

                    $start_index = ($page-1)*$posts_per_page;
                    $query ="SELECT * FROM posts $published_query ORDER BY id DESC LIMIT $start_index, $posts_per_page ";
                    $posts = query($query);

                    ?>
                    
                                               <!-- Pager -->
              <?php include "includes/pager.php"; ?>
                    
                    <?php
                    
                
                    if(mysqli_num_rows($posts) == 0){
                        echo "<h2>No posts!</h2>";
                    }else{


                        while($row = mysqli_fetch_assoc($posts)){
                            $id = $row['id'];
                            $title = $row['title'];
                            $cat_id = $row['cat_id'];
                            $author_id = $row['author_id'];
                            $date = $row['date'];
                            $comment_count = $row['comment_count'];
                            $content  = substr($row['content'],0,100);
                            $image = $row['image'];



                            if(!$author_id){
                                $author_name = "NOT DEFINED";
                            }else{
                                $query = "SELECT * FROM users WHERE id=$author_id";
                                $results = query($query);
                                $row = mysqli_fetch_assoc($results);

                                $author_name = $row['username'];
                            }




                        include "single_post.php";

                        }
                    }
                ?>


                <!-- Pager -->
              <?php include "includes/pager.php"; ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
             <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php" ?>