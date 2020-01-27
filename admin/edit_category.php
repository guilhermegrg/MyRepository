                           <?php
                            
                          
                            //update
                        if(isset($_POST['update'])){
                         
                            $name = $_POST['update_cat_name'];
                            $id = $_GET['update'];
                            
                            if($name == "" || empty($name)){
                                echo "Can't be empty!";
                                include "single_post_edit.php";
//                               header("Location: categories.php?edit=$id");
                            }else{
                                

                            $name = mysqli_real_escape_string($conn,$name);
                            
                                
                            $query = "UPDATE categories SET name=? WHERE id=?";
                            $stmt = mysqli_prepare($conn,$query);
                                
                            mysqli_stmt_bind_param($stmt,"si",$name,$id);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_store_result($stmt);
//                            mysqli_stmt_bind_result($prep_stmt, $id, $title, $status, $image, $tags, $views, $date, $author_id, $author_name, $comment_count, $content );
                            mysqli_stmt_close($stmt);
                                
//                            $query = "UPDATE categories SET name='$name' WHERE id=$id";
//                            $result = query($query);
                                
                                if(!$stmt){
                                    
                                    die("Could not update category. " . mysqli_error($conn));
                                    
                                }else{
                                    header("Location: categories.php");
                                }

                                
                                
                            }
                            
                        }
                            
                            
                          //open editor
                            if(isset($_GET['edit'])){
        
                                $edit_id = $_GET['edit'];

                                $query = "SELECT * FROM categories WHERE id=$edit_id";
                                $result = query($query);


                                $query = "SELECT * FROM categories WHERE id=?";
                                $stmt = mysqli_prepare($conn,$query);
                                
                                mysqli_stmt_bind_param($stmt,"i",$edit_id);
                                mysqli_stmt_execute($stmt);
                                mysqli_stmt_store_result($stmt);
                                mysqli_stmt_bind_result($stmt, $id, $name );
                                
                                

                                if(!$stmt){
                                    echo "Error reading category $edit_id " . mysqli_error($conn);
                                }else{
                        //            header("Location: categories.php");
                        //            $name=        
                                   // $row = mysqli_fetch_assoc($result);
                                    mysqli_stmt_fetch($stmt);
//                                    $id = $row['id'];
//                                    $name = $row['name'];
                                   
                                    include "single_post_edit.php";

                                }
                                
                                mysqli_stmt_close($stmt);
                          
                            }
                          
                          ?>