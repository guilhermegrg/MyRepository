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



                    if(isset($_SESSION['role']) && $_SESSION['role'] == "admin"){
                        
                        
                        $query = "SELECT posts.id, posts.title, posts.status, posts.image, posts.tags, posts.views, posts.date, posts.author_id, users.username as author_name, (SELECT COUNT(*) FROM comments  WHERE comments.post_id = posts.id) AS comment_count, content FROM posts ";
                        $query .= " LEFT JOIN users ON posts.author_id = users.id ";
                        $query .= "WHERE posts.cat_id=? ORDER BY posts.id DESC ";                        


    //                        $prep_stmt = mysqli_prepare($conn,"SELECT id, title, author_id, status, tags, content, image, date, comment_count FROM posts WHERE cat_id=? ORDER BY id DESC");
                        $prep_stmt = mysqli_prepare($conn,$query);

                        mysqli_stmt_bind_param($prep_stmt,'i',$cat_id);

                        
                        
                    }else{
                        
                        $query = "SELECT posts.id, posts.title, posts.status, posts.image, posts.tags, posts.views, posts.date, posts.author_id, users.username as author_name, (SELECT COUNT(*) FROM comments  WHERE comments.post_id = posts.id) AS comment_count, content FROM posts ";
                        $query .= " LEFT JOIN users ON posts.author_id = users.id ";
                        $query .= "WHERE posts.cat_id=? AND status=? ORDER BY posts.id DESC ";     
                        
                        $prep_stmt = mysqli_prepare($conn,$query);
//                        $prep_stmt = mysqli_prepare($conn,"SELECT id, title, author_id, status, tags, content, image, date, comment_count FROM posts WHERE cat_id=? AND status=? ORDER BY id DESC");

                        
                        $state = "published";
                        mysqli_stmt_bind_param($prep_stmt,'is',$cat_id,$state);
                    }



                    
//                    $query ="SELECT * FROM posts WHERE cat_id=$cat_id $published_query ORDER BY id DESC";
//                    $posts = query($query);


//                    $prep_stmt = mysqli_prepare($conn,"SELECT id, title, author_id, cat_id, status, tags, content, image, date, comment_count FROM posts WHERE cat_id=? ORDER BY id DESC");

//                    $query = "SELECT posts.id, posts.title, posts.status, posts.image, posts.tags, posts.views, posts.date, posts.author_id, users.username as author_name, (SELECT COUNT(*) FROM comments  WHERE comments.post_id = posts.id) AS comment_count, content FROM posts ";
//                    $query .= " LEFT JOIN users ON posts.author_id = users.id ";
//                    $query .= "WHERE posts.cat_id=? $published_query ORDER BY posts.id DESC ";
//

                    mysqli_stmt_execute($prep_stmt);
                    mysqli_stmt_store_result($prep_stmt);
                    mysqli_stmt_bind_result($prep_stmt, $id, $title, $status, $image, $tags, $views, $date, $author_id, $author_name, $comment_count, $content );

//mysqli_stmt_bind_result($prep_stmt, $id, $title, $author_id, $status, $tags, $content, $image, $date, $comment_count);


//                    var_dump($prep_stmt);
//                    $res = $prep_stmt->get_result();
//                    $row = $res->fetch_assoc();

//                        echo "<h1>" . mysqli_stmt_num_rows($prep_stmt) . "</h1>";


                    if(mysqli_stmt_num_rows($prep_stmt) === 0){
                        echo "<h2>No posts!</h2>";
                    }else{
                    
                            while(mysqli_stmt_fetch($prep_stmt)){
//                                $id = $row['id'];
//                                $title = $row['title'];
//                                $cat_id = $row['cat_id'];
//                                $author_id = $row['author_id'];
//                                $date = $row['date'];
//                                $comment_count = $row['comment_count'];
//                                $content  = substr($row['content'],0,100);
//                                $image = $row['image'];
                                
//                                    $author_name = $row['author_name'];
                                      if(empty($author_name))
                                      {
                                          $author_name = "NOT DEFINED";
                                      }
                                      
//                            if(!$author_id){
//                                $author_name = "NOT DEFINED";
//                            }else{
//                                $query = "SELECT * FROM users WHERE id=$author_id";
//                                $results = query($query);
//                                $row = mysqli_fetch_assoc($results);
//
//                                $author_name = $row['username'];
//                            }


                            include "single_post.php";

                            }
                        
                            mysqli_stmt_close($prep_stmt);
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