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
        
        case 'publish':
            $query = "UPDATE posts SET status='published' WHERE id IN (" . $ids . ")";
            $result = query($query);
        break;

        case 'draft':
            $query = "UPDATE posts SET status='draft' WHERE id IN (" . $ids . ")";
            $result = query($query);
        break;

        case 'delete':
            $query = "DELETE FROM posts WHERE id IN (" . $ids . ")";
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
                                            <option value="publish">Publish</option>
                                            <option value="draft">Draft</option>
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
                                   <th>Date</th>
                                   <th>View Post</th>
                                   <th>Edit</th>
                                   <th>Delete</th>

                               </tr>
                           </theader>
                           <tbody>
                              
                              
                               <?php

                        
                        if(isset($_GET['delete'])){
                            
                            $id=$_GET['delete'];
                            $query = "DELETE FROM posts WHERE id=$id";
                            query($query);
                            header("Location: posts.php");
                            
                        }
                        
                        
                        ?>
                              
                              <?php
                              
                              $query = "SELECT * FROM posts ORDER BY date DESC";
                              
                              $posts = query($query);
                              
                              if(!$posts){
                                  echo "Error doing query!";
                              }else{
                                  
                                  while($row = mysqli_fetch_assoc($posts)){
                                      $id = $row['id'];
                                      $author = $row['author'];
                                      $title = $row['title'];
                                      $cat_id = $row['cat_id'];
                                      $status = $row['status'];
                                      $image = $row['image'];
                                      $tags = $row['tags'];
                                      $comment_count = $row['comment_count'];
                                      $date = $row['date'];
                                      
                                      
                                      
                                      $query = "SELECT * FROM categories WHERE id=$cat_id";
                                      $cats = query($query);
                                      $cat = mysqli_fetch_assoc($cats);
                                      $cat_name = $cat['name'];
                                      
                                      
                                      echo "<tr>";
                                      echo "<td><input type='checkbox' name='checkBoxArray[]' value='$id' class='checkBoxes' ></td>";
                                      echo "<td>$id</td>";
                                      echo "<td>$author</td>";
                                      echo "<td><a href='../post.php?id=$id' >$title</a></td>";
                                      echo "<td>$cat_name</td>";
                                      echo "<td>$status</td>";
                                      echo "<td><img width='100' src='../images/$image' alt='image'></td>";
                                      echo "<td>$tags</td>";
                                      echo "<td>$comment_count</td>";
                                      echo "<td>$date</td>";
                                      echo "<td><a href='../post.php?id=$id' >View Post</a></td>";
                                      echo "<td><a href='?source=edit_post&id=$id' >Edit</a></td>";
                                      echo "<td><a href='?delete=$id' >Delete</a></td>";
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