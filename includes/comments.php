
               
<?php


    if(isset($_POST['create_comment'])){
        
        $author = $_POST['comment_author'];
        $email = $_POST['comment_email'];
        $content = $_POST['comment_content'];
        
        if(!empty($author) && !empty($email) && !empty($content) ){
        
            $status = "unapproved";
            $date = date('Y-m-d H:i:s');
            $post_id = $id;

            
            

            $query = "INSERT INTO comments (author,email,content,status,date,post_id) VALUES ('$author','$email','$content','$status','$date',$post_id)";
            $result = query($query);



            $query = "UPDATE posts SET comment_count = comment_count + 1 WHERE id=$post_id";
            $result = query($query);
        }else
        {
            
            echo "<script>alert('Commentary fields cannot be empty!');</script>";
            
        }
    }

?>
               
               <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="post" action="">
                      
                       <div class="form-group">
                            <label for="comment_author">Name</label>
                            <input type="text" name="comment_author" class="form-control" >
                        </div>
                        
                       <div class="form-group">
                            <label for="comment_email">Email</label>
                            <input type="email" name="comment_email" class="form-control" >
                        </div>

                        <div class="form-group">
                            <label for="comment_content">Your Comment</label>
                            <textarea name="comment_content" class="form-control" rows="3"></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php 

                    $query = "SELECT * FROM comments WHERE post_id = $id AND status='approved'";
                    $comments = query($query);
                    while($row = mysqli_fetch_assoc($comments)){
                        $author = $row['author'];
                        $email = $row['email'];
                        $date = $row['date'];
                        $content = $row['content'];
                    


                ?>
               
               <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $author; ?>
                           <small><?php echo $email; ?></small>
                            <small><?php echo $date; ?></small>
                        </h4>
                        <?php echo $content; ?>
                    </div>
                </div>
                
                <?php
                        
                  }
                        
                ?>



            