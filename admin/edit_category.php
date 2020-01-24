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
                            
                            $query = "UPDATE categories SET name='$name' WHERE id=$id";
                            $result = query($query);
                                
                                if(!$result){
                                    
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



                                if(!$result){
                                    echo "Error reading category $edit_id " . mysqli_error($conn);
                                }else{
                        //            header("Location: categories.php");
                        //            $name=        
                                    $row = mysqli_fetch_assoc($result);
                                    $id = $row['id'];
                                    $name = $row['name'];
                                   
                                    include "single_post_edit.php";

                                }
                          
                          
                            }
                          
                          ?>