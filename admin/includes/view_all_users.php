
                          

                                    <table class="table table-bordered table-hover">
                           <theader>
                               <tr>
                                   <th>Id</th>
                                   <th>Username</th>
                                   <th>Email</th>
                                   <th>Firstname</th>
                                   <th>Lastname</th>
                                   <th>Active</th>
                                   <th>Role</th>
                                   <th>Image</th>
                                   <th>Activate</th>
                                   <th>Deactivate</th>
                                   <th>Edit</th>
                                   <th>Delete</th>
                               </tr>
                           </theader>
                           <tbody>
                              
                              
                               <?php

                        
                        if(isset($_GET['delete'])){
                            
                            if(!isset($_SESSION['role'])){
//                                echo "NO USER ROLE!!!";
                                header("Location: ../index.php");
                            }else{
                            
                                $user_role = $_SESSION['role'];
                                if($user_role == "admin"){
                                
                                    
                                    
                                    
                                    $id=$_GET['delete'];

                                    $id = mysqli_real_escape_string($conn,$id);

                                    $query = "DELETE FROM users WHERE id=$id";
                                    query($query);

                                    header("Location: users.php");
                                }else{
                                    
//                                    echo "NO ADMIN!!!";
                                    
                                    header("Location: ../index.php");
                                }
                            }
                            
                            
                        }else
                        if(isset($_GET['activate'])){
                            
                            $id=$_GET['activate'];
                            $query = "UPDATE users SET active = 1 WHERE id=$id";
                            query($query);
                            header("Location: users.php");
                            
                        }else
                        if(isset($_GET['deactivate'])){
                            
                            $id=$_GET['deactivate'];
                            $query = "UPDATE users SET active = 0 WHERE id=$id";
                            query($query);
                            header("Location: users.php");
                            
                        }else
                        
                        
                        ?>
                              
                              <?php
                              
                              $query = "SELECT * FROM users";
                              
                              $posts = query($query);
                              
                              if(!$posts){
                                  echo "Error doing query!";
                              }else{
                                  
                                  while($row = mysqli_fetch_assoc($posts)){
                                      $id = $row['id'];
                                      $username = $row['username'];
                                      $email = $row['email'];
                                      $firstname = $row['firstname'];
                                      $lastname = $row['lastname'];
                                      $active = $row['active'];
                                      $role = $row['role'];
                                      $profileimage = $row['profileimage'];
//                                      $date = $row['date'];
                                      
                                      $active_value = $active?"true":"false";
//                                      
                                      
                                      echo "<tr>";
                                      echo "<td>$id</td>";
                                      echo "<td>$username</td>";
                                      echo "<td>$email</td>";
                                      echo "<td>$firstname</td>";
                                      echo "<td>$lastname</td>";
                                      echo "<td>$active_value</td>";
                                      echo "<td>$role</td>";
                                      echo "<td><img width='100' src='../images/$profileimage' alt='image'></td>";
                                      echo "<td><a href='?activate=$id' >Activate</a></td>";
                                      echo "<td><a href='?deactivate=$id' >Deactivate</a></td>";
                                      echo "<td><a href='?source=edit_user&id=$id' >Edit</a></td>";
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