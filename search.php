<?php include "includes/header.php" ?>
   
   
    <!-- Navigation -->
    <?php include "includes/navigation.php" ?>
    
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

<?php
//                include "includes/db.php";
               
               if(isset($_POST['search'])){
                   
                   $search = $_POST['search'];
                   
                   $search = mysqli_real_escape_string($conn,$search);
                   
                   $query = "SELECT * FROM posts  WHERE tags LIKE '%$search%'";
                   $posts = query($query);
    
//                    $query ="SELECT * FROM posts";
//                    $posts = query($query);

                    
                    while($row = mysqli_fetch_assoc($posts)){
                        $title = $row['title'];
                        $cat_id = $row['cat_id'];
                        $author_id = $row['author_id'];
                        $date = $row['date'];
                        $content  = $row['content'];
                        $image = $row['image'];
    
                    


                    include "single_post.php";
                        
                    }
                   
               }else{
                   echo "<h1>No Results!</h1>";
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