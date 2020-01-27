
<?php include "delete_modal.php"; ?>


<?php

if(isset($_GET['reset_views'])){
    
    $id = $_GET['reset_views'];
    
    $query = "UPDATE posts SET views = 0 WHERE id=$id";
    $result = query($query);
    header("Location: posts.php");
    
}else
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
        
        case 'publish':
            $query = "UPDATE posts SET status='published' WHERE id IN (" . $ids . ")";
            $result = query($query);
        break;

        case 'draft':
            $query = "UPDATE posts SET status='draft' WHERE id IN (" . $ids . ")";
            $result = query($query);
        break;

        case 'delete':
//            echo "<script>alert('nooooooo!');</script>";
            $query = "DELETE FROM posts WHERE id IN (" . $ids . ")";
            $result = query($query);
        break;
            
        case 'reset_views':
            $query = "UPDATE posts SET views = 0 WHERE id IN (" . $ids . ")";
            $result = query($query);
            break;
            
        case 'clone':
            
            foreach($array as $id){
            
                
                      $query = "SELECT * FROM posts   WHERE id=$id";    
                      $posts= query($query);
                
                
                      $row = mysqli_fetch_assoc($posts);
                      $id = $row['id'];
                      $author = $row['author'];
                      $author_id = $row['author_id'];
                      $title = $row['title'];
                      $content = $row['content'];
                      $cat_id = $row['cat_id'];
                      $status = $row['status'];
                      $image = $row['image'];
                      $tags = $row['tags'];
                      $comment_count = 0;
                      $date = $row['date'];
                 
                
                    $title = mysqli_real_escape_string($conn,$title);
                    $content = mysqli_real_escape_string($conn,$content);
                
                
                    $query = "INSERT INTO posts(title, author, author_id, cat_id, status, tags, content, image, date, comment_count) VALUES('$title', '$author', $author_id,  $cat_id, '$status', '$tags', '$content', '$image', '$date', $comment_count)";
                    query($query);
                    $last_id = $conn->insert_id;
                
            }
            
            
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
                                            <option value="publish">Publish</option>
                                            <option value="draft">Draft</option>
                                            <option value="clone">Clone</option>
                                            <option value="reset_views">Reset Views</option>
                                            <option value="delete">Delete</option>
                                            
                                        </select>
                                        
                                       
                                    </div>
                                     <div class="col-xs-4">
                                            <input type="submit" value="Apply" name="submit" class="btn btn-success">
                                            <a class="btn btn-primary" href="posts.php?source=add_post">Add Post</a>
                                     </div>
                                    
                                    
                           <theader>
                               <tr>
                                  <th><input type="checkbox" id="selectAllBoxes"></th>
                                   <th>Id</th>
                                   <th>Author</th>
                                   <th>Title</th>
                                   <th>Category</th>
                                   <th>Status</th>
                                   <th>Image</th>
                                   <th>Tags</th>
                                   <th>Comments</th>
                                   <th>Views</th>
                                   <th>Date</th>
                                   <th>View Post</th>
                                   <th>Edit</th>
                                   <th>Reset Views</th>
                                   <th>Delete</th>

                               </tr>
                           </theader>
                           <tbody>
                              
                              
                               <?php

                        
                        if(isset($_POST['delete'])){
                            
                            if(!isset($_SESSION['role'])){
//                                echo "NO USER ROLE!!!";
                                header("Location: ../index.php");
                            }else{
                            
                                $user_role = $_SESSION['role'];
                                if($user_role == "admin"){
                            
                                    $id=$_POST['post_id'];
                                    $query = "DELETE FROM posts WHERE id=$id";
                                    query($query);
                                    header("Location: posts.php");
                                }else{
                                    header("Location: ../index.php");
                                }
                            
                            }   
                        }
                        
                        
                        ?>
                              
                              <?php
                              
//                              $query = "SELECT * FROM posts ORDER BY id DESC";
                              $query = "SELECT posts.id, posts.title, posts.status, posts.image, posts.tags, posts.views, posts.date, posts.cat_id, users.username as author_name, categories.name AS cat_name, (SELECT COUNT(*) FROM comments  WHERE comments.post_id = posts.id) AS comment_count FROM posts ";
                              $query .= " LEFT JOIN users ON posts.author_id = users.id ";
                               $query .= " LEFT JOIN categories ON posts.cat_id = categories.id ";
                               $query .= " ORDER BY posts.id DESC ";
//                               $query .= " LEFT JOIN (SELECT ) comments ON posts.id = comments.post_id ";
                              
                              $posts = query($query);
                              
                              if(!$posts){
                                  echo "Error doing query!";
                              }else{
                                  
                                  while($row = mysqli_fetch_assoc($posts)){
                                      $id = $row['id'];
                                      //$author_id = $row['author_id'];
                                      $title = $row['title'];
                                      //$cat_id = $row['cat_id'];
                                      $status = $row['status'];
                                      $image = $row['image'];
                                      $tags = $row['tags'];
                                      $comment_count = $row['comment_count'];
                                      $views = $row['views'];
                                      $date = $row['date'];
                                      
                                      $author_name = $row['author_name'];
                                      if(empty($author_name))
                                      {
                                          $author_name = "NOT DEFINED";
                                      }
                                      
                                      $cat_name = $row['cat_name'];
                                      if(empty($cat_name))
                                      {
                                          $cat_name = "NOT DEFINED";
                                      }

                                      
                                      
//                                      $query = "SELECT * FROM comments WHERE post_id=$id";
//                                      $results = query($query);
//                                      $comment_count = mysqli_num_rows($results);
                                      
                                      
//                                      $query = "SELECT * FROM categories WHERE id=$cat_id";
//                                      $cats = query($query);
//                                      $cat = mysqli_fetch_assoc($cats);
//                                      $cat_name = $cat['name'];
                                      
                                      
//                                      if(!$author_id){
//                                        $author_name = "NOT DEFINED";
//                                      }else{
//                                          $query = "SELECT * FROM users WHERE id=$author_id";
//                                          $results = query($query);
//                                          $row = mysqli_fetch_assoc($results);
//
//                                          $author_name = $row['username'];
//                                      }
                                      
                                      
                                      echo "<tr>";
                                      echo "<td><input type='checkbox' name='checkBoxArray[]' value='$id' class='checkBoxes' ></td>";
                                      echo "<td>$id</td>";
                                      echo "<td>$author_name</td>";
                                      echo "<td><a href='../post.php?id=$id' >$title</a></td>";
                                      echo "<td>$cat_name</td>";
                                      echo "<td>$status</td>";
                                      echo "<td><img width='100' src='../images/$image' alt='image'></td>";
                                      echo "<td>$tags</td>";
                                      echo "<td><a href='?source=view_comments&post_id=$id'>$comment_count</a></td>";
                                      echo "<td>$views</td>";
                                      echo "<td>$date</td>";
                                      echo "<td><a class='btn btn-primary' href='../post.php?id=$id' >View Post</a></td>";
                                      echo "<td><a class='btn btn-info' href='?source=edit_post&id=$id' >Edit</a></td>";
                                      echo "<td><a href='?reset_views=$id' >Reset Views</a></td>";
//                                    echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?')\" href='?delete=$id' >Delete</a></td>";
                                      
                                      
                                    ?>  
<!--
                                      <td>
                                      <form action="POST">
                                          <input type="hidden" name='post_id' value='<?php echo $id; ?>'>
                                          <input rel='$id' type="submit" name="delete" value="Delete" class="btn btn-danger delete_link">
                                      </form>
                                       </td>
                                      
-->
                                      
                                    <?php
                                      
                                      echo "<td><a rel='$id' href='javascript:void(0)' class='btn btn-danger delete_link'>Delete</a></td>";
                                      
                                      
                                      
                                      
                                      
                                      
                                      echo "</tr>";
                                      
                                      
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
                      







<script>

$(document).ready(function(){
    
    
    $(".delete_link").on('click',function(){
        
        
//        alert('Hellooooo');
        
        var id = $(this).attr('rel');
//        var delete_url = "?delete=" + id;
//        alert(delete_url);
        
        $(".modal_delete_link").attr('value',id);
        $("#myModal").modal("show");
        
        
    });
    
});





</script>