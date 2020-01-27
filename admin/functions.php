<?php


function isUsernameRegistered($username){
    $query = "SELECT * FROM users WHERE username = '$username'";
    $results = query($query);
    $count = mysqli_num_rows($results);
    
    if($count == 1){
        $row = mysqli_fetch_assoc($results);
        return $row['id'];
    }elseif($count > 1){
        return -1;
    }else
    return 0;
    
}

function isEmailRegistered($email){
    $query = "SELECT * FROM users WHERE email = '$email'";
    $results = query($query);
    $count = mysqli_num_rows($results);
    
   if($count == 1){
        $row = mysqli_fetch_assoc($results);
        return $row['id'];
    }elseif($count > 1){
        return -1;
    }else
    return 0;
    
}


function escape($string){
    global $conn;
    return mysqli_real_escape_string($conn,trim($string));
}

function getOnlineUsers(){

    global $conn;
    
    if(!$conn){
        include("../includes/db.php");
    }
                
                $query = "SELECT * FROM user_sessions WHERE time > " . (time()-3);
                $results = query($query);
                $user_count  = mysqli_num_rows($results);
                echo $user_count;
}


if(isset($_GET['getonlineusers'])){
    return getOnlineUsers();
}


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