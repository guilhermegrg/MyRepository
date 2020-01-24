
                          

                                    <table class="table table-bordered table-hover">
                           <theader>
                               <tr>
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
                            
                            $id=$_GET['delete'];
                            
                            
                            $query = "SELECT * FROM comments WHERE id=$id";
                            $results = query($query);
                            $row = mysqli_fetch_assoc($results);
                            $post_id = $row['row_id'];
                            
                            $query = "DELETE FROM comments WHERE id=$id";
                            query($query);
                            
                            
                            
                            $query = "UPDATE posts SET comment_count = comment_count - 1 WHERE id=$post_id";
                            query($query);
                            
                            header("Location: comments.php");
                            
                        }else
                        if(isset($_GET['approve'])){
                            
                            $id=$_GET['approve'];
                            $query = "UPDATE comments SET status = 'approved' WHERE id=$id";
                            query($query);
                            header("Location: comments.php");
                            
                        }else
                        if(isset($_GET['unapprove'])){
                            
                            $id=$_GET['unapprove'];
                            $query = "UPDATE comments SET status = 'unapproved' WHERE id=$id";
                            query($query);
                            header("Location: comments.php");
                            
                        }else
                        
                        
                        ?>
                              
                              <?php
                              
                              $query = "SELECT * FROM comments";
                              
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
                                      echo "<td>$id</td>";
                                      echo "<td>$author</td>";
                                      echo "<td>$email</td>";
                                      echo "<td><a href='../post.php?id=$post_id'>$post_title</a></td>";
                                      echo "<td>$status</td>";
//                                      echo "<td><img width='100' src='../images/$image' alt='image'></td>";
//                                      echo "<td>$tags</td>";
                                      echo "<td>$content</td>";
                                      echo "<td>$date</td>";
                                      echo "<td><a href='?approve=$id' >Approve</a></td>";
                                      echo "<td><a href='?unapprove=$id' >Unapprove</a></td>";
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