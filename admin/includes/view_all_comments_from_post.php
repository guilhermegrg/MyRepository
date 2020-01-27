<?php
   

   if(isset($_POST['checkBoxArray']) && isset($_POST['bulkAction'])){
    
    
    $array=$_POST['checkBoxArray'];
    $action = $_POST['bulkAction'];
//    print_r($array);
    $ids = "";
    foreach($array as $id){
        $ids.= $id . ", ";
    }
    
    $ids = str_lreplace(", ","",$ids);
    
    switch($action){
        
        case 'approve':
            $query = "UPDATE comments SET status='approved' WHERE id IN (" . $ids . ")";
            $result = query($query);
        break;

        case 'unapprove':
            $query = "UPDATE comments SET status='unapproved' WHERE id IN (" . $ids . ")";
            $result = query($query);
        break;

        case 'delete':
//            echo "<script>alert('nooooooo!');</script>";
            $query = "DELETE FROM comments WHERE id IN (" . $ids . ")";
            $result = query($query);
        break;
            
                  
        default:
        break;
    }
    
    
    
}




?>
       <form action="" method="post">                   

                        <table class="table table-bordered table-hover">
                          
                          
                                    <div id="bulkOptionContainer" class="col-xs-4">
                                        
                                        <select class="form-control" name="bulkAction" id="">
                                            <option value="">Select Options</option>
                                            <option value="approve">Approve</option>
                                            <option value="unapprove">Unapprove</option>
                                            <option value="delete">Delete</option>
                                            
                                        </select>
                                        
                                       
                                    </div>
                                     <div class="col-xs-4">
                                            <input type="submit" value="Apply" name="submit" class="btn btn-success">
<!--                                            <a class="btn btn-primary" href="posts.php?source=add_post">Add Post</a>-->
                                     </div>                          
                          
                          
                           <theader>
                               <tr>
                                  <th><input type="checkbox" id="selectAllBoxes"></th>
                                   <th>Id</th>
                                   <th>Author</th>
                                   <th>Email</th>
                                   <th>In Response to</th>
                                   <th>Status</th>
                                   <th>Content</th>
                                   <th>Date</th>
                                   <th>Approve</th>
                                   <th>Unapprove</th>
                                   <th>Delete</th>
                               </tr>
                           </theader>
                           <tbody>
                              
                              
                               <?php

                        
                        if(isset($_GET['delete'])){
                            
                            
                            $post_id=$_GET['post_id'];
                            $id=$_GET['delete'];
                            
                            
//                            $query = "SELECT * FROM comments WHERE id=$id";
//                            $results = query($query);
//                            $row = mysqli_fetch_assoc($results);
//                            $post_id = $row['row_id'];
                            
                            $query = "DELETE FROM comments WHERE id=$id";
                            query($query);
                            
                            
                            
//                            $query = "UPDATE posts SET comment_count = comment_count - 1 WHERE id=$post_id";
//                            query($query);
                            
                            header("Location: posts.php?source=view_comments&post_id=$post_id");
                            
                        }else
                        if(isset($_GET['approve'])){
                            
                            $id=$_GET['approve'];
                            $post_id=$_GET['post_id'];
                            
                            $query = "UPDATE comments SET status = 'approved' WHERE id=$id";
                            query($query);
                            
                            header("Location: posts.php?source=view_comments&post_id=$post_id");
                            
                        }else
                        if(isset($_GET['unapprove'])){
                            
                            $id=$_GET['unapprove'];
                            $post_id=$_GET['post_id'];
                            
                            $query = "UPDATE comments SET status = 'unapproved' WHERE id=$id";
                            query($query);
                            
                            header("Location: posts.php?source=view_comments&post_id=$post_id");
                            
                        }
                        
                        
                        ?>
                              
                              <?php
                              
                                if(isset($_GET['post_id'])){
                            
                                    $post_id = $_GET['post_id'];
                                    
                              $query = "SELECT * FROM comments WHERE post_id = $post_id";
                              
                              $posts = query($query);
                              
                              if(!$posts){
                                  echo "Error doing query!";
                              }else{
                                  
                                  while($row = mysqli_fetch_assoc($posts)){
                                      $id = $row['id'];
                                      $author = $row['author'];
                                      $email = $row['email'];
                                      $post_id = $row['post_id'];
                                      $status = $row['status'];
                                      $content = $row['content'];
                                      $date = $row['date'];
                                      
                                      
                                      
                                      $query = "SELECT * FROM posts WHERE id=$post_id";
                                      $results = query($query);
                                      $refered_post = mysqli_fetch_assoc($results);
                                      $post_title = $refered_post['title'];
//                                      $query = "SELECT * FROM categories WHERE id=$cat_id";
//                                      $cats = query($query);
//                                      $cat = mysqli_fetch_assoc($cats);
//                                      $cat_name = $cat['name'];
//                                      
                                      
                                      echo "<tr>";
                                      echo "<td><input type='checkbox' name='checkBoxArray[]' value='$id' class='checkBoxes' ></td>";
                                      echo "<td>$id</td>";
                                      echo "<td>$author</td>";
                                      echo "<td>$email</td>";
                                      echo "<td><a href='../post.php?id=$post_id'>$post_title</a></td>";
                                      echo "<td>$status</td>";
//                                      echo "<td><img width='100' src='../images/$image' alt='image'></td>";
//                                      echo "<td>$tags</td>";
                                      echo "<td>$content</td>";
                                      echo "<td>$date</td>";
                                      echo "<td><a href='?source=view_comments&post_id=$post_id&approve=$id' >Approve</a></td>";
                                      echo "<td><a href='?source=view_comments&post_id=$post_id&unapprove=$id' >Unapprove</a></td>";
                                      echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?')\" href='?source=view_comments&post_id=$post_id&delete=$id' >Delete</a></td>";
                                      echo "</tr>";
                                      
                                      
                                  }
                                  
                                  
                              }
                                }
                              
                              
                              ?>
                              
<!--
                               <tr>
                                   <td>1</td>
                                   <td>qwe</td>
                                   <td>qwerty</td>
                                   <td>sql</td>
                                   <td>draft</td>
                                   <td></td>
                                   <td>asdasd</td>
                                   <td>34</td>
                                   <td>2020-1-29</td>
                               </tr>
-->
                               
                               
                               
                               
                           </tbody>
                       </table>
</form>