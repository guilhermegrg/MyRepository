<?php

//function clean($string){
//    global $conn;
//    return mysqli_real_escape_string($conn,trim($string));
//}

function insertTokenInUserById($id,$token){
    global $conn;
    
    $query = "UPDATE users SET token=? WHERE id=?";
    $stmt = mysqli_prepare($conn,$query);
    mysqli_stmt_bind_param($stmt,"si",$token,$id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    //mysqli_stmt_bind_result($stmt, $user_id);
    
//    $count = mysqli_stmt_num_rows($stmt); 
    mysqli_stmt_close($stmt);
//    if($count == 0){
//        mysqli_stmt_close($stmt);
//        return 0;
//    }else{
//        mysqli_stmt_fetch($stmt);
}

function getToken($length=50){
    return bin2hex(openssl_random_pseudo_bytes($length));
}

function getUserByEmail($email){
    
    global $conn;
    
   $email = mysqli_real_escape_string($conn, trim($email));

    
//    echo $username ;
    
    $query = "SELECT id FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn,$query);
    mysqli_stmt_bind_param($stmt,"s",$email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $user_id);
    
    $count = mysqli_stmt_num_rows($stmt); 
    
    if($count == 0){
        mysqli_stmt_close($stmt);
        return 0;
    }else{
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        return $user_id;
        
    }
}


function loginUser($username,$password){
    global $conn;
    
    $username = mysqli_real_escape_string($conn, trim($username));
    $password = mysqli_real_escape_string($conn, trim($password));

    
//    echo $username ;
    
    $query = "SELECT id, password, role, firstname, lastname FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn,$query);
    mysqli_stmt_bind_param($stmt,"s",$username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $user_id, $user_password, $role, $firstname, $lastname);
    
    $count = mysqli_stmt_num_rows($stmt);
    
//    mysqli_stmt_fetch($stme);
    
    
    

    
    
//    $results = query($query);
//    
//    $count = mysqli_num_rows($results);
    
    
    if($count == 0){
        echo "No user name $username";
        redirect("/cms/");
    }else{
//        echo "found that guy $username";
        mysqli_stmt_fetch($stmt);
//        $row = mysqli_fetch_assoc($results);
        
//        $user_id = $row['id'];
//        $user_password = $row['password'];
//        $role = $row['role'];
//        $firstname = $row['firstname'];
//        $lastname = $row['lastname'];
        
        if(!password_verify($password,$user_password)){
//            echo "Not valid pass!";
            mysqli_stmt_close($stmt);
            redirect("/cms/");
        }else{
            
            echo "Valid pass!";
            session_start();
            $_SESSION['user_id']=$user_id;
            $_SESSION['username']=$username;
            $_SESSION['firstname']=$firstname;
            $_SESSION['lastname']=$lastname;
            $_SESSION['role']=$role;
            mysqli_stmt_close($stmt);
            redirect("/cms/admin");
        }
        
    }
    
}


function redirect($target){
    header("Location: ". $target );
    exit;
}

function ifItIsMethod($method=null){
    
    if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){
        return true;
    }else
        return false;
}


function isLoggedIn(){
    return isset($_SESSION['user_id']);
}

function getUserId(){
    return $_SESSION['user_id'];
}

function isPostLiked($post_id){
    $user_id = getUserId();
    $query = "SELECT * FROM likes WHERE post_id = $post_id AND user_id = $user_id";
    $results = query($query);
    
    $count = mysqli_num_rows($results);
    
    
//    echo "<h1>Like count: $count</h1>";
    
    return $count>0;
}

function getPostLikes($post_id){
    $query = "SELECT like_count FROM posts WHERE id = $post_id";
    $results = query($query);
    
    $row = mysqli_fetch_assoc($results);
    $like_count = $row['like_count'];
    
    return $like_count;
}


function checkIfUserIsLoggedInAndRedirect($redirectLocation="/cms/index"){
    if(isLoggedIn()){
        redirect($redirectLocation);
    }
}


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
                                

                            $name = mysqli_real_escape_string($conn,trim($name));
                            
                                
                            $query = "INSERT INTO categories (name) VALUES (?)";
                            $stmt = mysqli_prepare($conn,$query);
                                
                            mysqli_stmt_bind_param($stmt,"s",$name);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_store_result($stmt);                                
                                
                                 mysqli_stmt_close($stmt);
//                            $query = "INSERT INTO categories (name) VALUES ('$name')";
//                            $result = query($query);
                                
                                if(!$stmt){
                                    
                                    die("Could not create category. " . mysqli_error($conn));
                                    
                                }

                                
                                
                            }
                            
                            
                        }
}

function  deleteCategory(){
        global $conn;
    
        if(isset($_GET['delete'])){
        
        $delete_id = $_GET['delete'];
        
        $query = "DELETE FROM categories WHERE id=?";
        $stmt = mysqli_prepare($conn,$query);

        mysqli_stmt_bind_param($stmt,"i",$delete_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);                                

        mysqli_stmt_close($stmt);            
            
            
//        $query = "DELETE FROM categories WHERE id=$delete_id";
//        $result = query($query);
        
        if(!$stmt){
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