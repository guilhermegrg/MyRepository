<?php include "includes/header.php" ?>
   
   
    <!-- Navigation -->
    <?php include "includes/navigation.php" ?>
    
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

<?php
    
                    if(isset($_GET['author_id'])){
                        $author_id = $_GET['author_id'];
                        $author_id = mysqli_real_escape_string($conn,$author_id);
                        
                        
                        if(!$author_id){
                            $author_name = "NOT DEFINED";
                        }else{
                            $query = "SELECT * FROM users WHERE id=$author_id";
                            $results = query($query);
                            $row = mysqli_fetch_assoc($results);

                            $author_name = $row['username'];
                        }

                        
                        
                    }else{
                        header("Location: index.php");
                    }





                    if(isset($_SESSION['role'])){
                        $role = $_SESSION['role'];
                        if($role == 'admin')
                        {
                            $published_query =  "";
                        }else{
                            $published_query =  " AND status='published'";
                        }
                    }else{
                        $published_query =  " AND status='published'";
                    }





                    $query ="SELECT * FROM posts WHERE author_id='$author_id'  $published_query ORDER BY id DESC";
                    $posts = query($query);

                    if(mysqli_num_rows($posts) == 0){
                        echo "<h2>No posts!</h2>";
                    }else{
                        while($row = mysqli_fetch_assoc($posts)){
                            $id = $row['id'];
                            $title = $row['title'];
                            $cat_id = $row['cat_id'];

                            $date = $row['date'];
                            $comment_count = $row['comment_count'];
                            $content  = substr($row['content'],0,100);
                            $image = $row['image'];




                        include "single_post.php";

                        }

                    }
                        
                ?>


                <!-- Pager -->
<!--
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>
-->

            </div>

            <!-- Blog Sidebar Widgets Column -->
             <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php" ?>