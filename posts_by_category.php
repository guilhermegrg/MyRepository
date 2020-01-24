<?php include "includes/header.php" ?>
   
   
    <!-- Navigation -->
    <?php include "includes/navigation.php" ?>
    
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

<?php
    
                    if(isset($_GET['cat_id'])){
                        $cat_id = $_GET['cat_id'];
                    }else{
                        header("Location: index.php");
                    }
    
                    $query ="SELECT * FROM posts WHERE cat_id=$cat_id";
                    $posts = query($query);

                    
                    while($row = mysqli_fetch_assoc($posts)){
                        $id = $row['id'];
                        $title = $row['title'];
                        $cat_id = $row['cat_id'];
                        $author = $row['author'];
                        $date = $row['date'];
                        $content  = substr($row['content'],0,100);
                        $image = $row['image'];
    
                    


                    include "single_post.php";
                        
                    }
                        
                ?>


                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div>

            <!-- Blog Sidebar Widgets Column -->
             <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php" ?>