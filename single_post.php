<!--
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
-->

                <!-- First Blog Post -->

                
                <h2>
                    <a href="post.php?id=<?php echo $id; ?>"><?php echo $title; ?></a>
                </h2>

               <?php if($author_id){ ?>
                <p class="lead">
                    by <a href="posts_by_author.php?author_id=<?php echo $author_id; ?>"><?php echo $author_name; ?></a>
                </p>
                <?php } ?>
                               
                
                
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $date; ?></p>
<!--
                <?php
                    $query = "SELECT * FROM comments WHERE post_id=$id";
                    $results = query($query);
                    $comment_count = mysqli_num_rows($results);
                ?>
-->
                
                 <p><span class="glyphicon glyphicon-comment"></span> <?php echo $comment_count; ?></p>
                 
                 
                 
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
                    <a href="post.php?id=<?php echo $id; ?>" >
                        <img class="img-responsive" src="images/<?php echo $image; ?>" alt="">
                    </a>
                <hr>
                
                
                
                
                <p><?php echo $content; ?></p>
                <a class="btn btn-primary" href="post.php?id=<?php echo $id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>