<?php


function str_lreplace($search, $replace, $subject)
{
    $pos = strrpos($subject, $search);

    if($pos !== false)
    {
        $subject = substr_replace($subject, $replace, $pos, strlen($search));
    }

    return $subject;
}

function insertCategories(){
                        global $conn;
//create
                        if(isset($_POST['submit'])){
                         
                            $name = $_POST['cat_name'];
                            
                            if($name == "" || empty($name)){
                                echo "Can't be empty!";
                            }else{
                                

                            $name = mysqli_real_escape_string($conn,$name);
                            
                            $query = "INSERT INTO categories (name) VALUES ('$name')";
                            $result = query($query);
                                
                                if(!$result){
                                    
                                    die("Could not create category. " . mysqli_error($conn));
                                    
                                }

                                
                                
                            }
                            
                            
                        }
}

function  deleteCategory(){
    
        if(isset($_GET['delete'])){
        
        $delete_id = $_GET['delete'];
        
        $query = "DELETE FROM categories WHERE id=$delete_id";
        $result = query($query);
        
        if(!$result){
            echo "Error deleting category $delete_id " . mysqli_error($conn);
        }else{
            header("Location: categories.php");
        }
        
        
    }
                                
    
}


function showAllCategories(){

    
    
                                $query ="SELECT * FROM categories";
                                $cats = query($query);

                    
                    while($row = mysqli_fetch_assoc($cats)){
                        $id = $row['id'];
                        $name = $row['name'];
                       
                                echo "<tr>";
                                echo "<td>$id</td>";
                                echo "<td>$name</td>";
                                echo "<td><a href='?delete=$id' >Delete</a></td>";
                                echo "<td><a href='?edit=$id' >Edit</a></td>";
                                echo "</tr>";
                        
                       
                    }
        
}
    


?>