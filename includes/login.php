<?php ob_start(); ?>
<?php session_start(); ?>

<?php include "db.php"; ?>


<?php 


if(isset($_POST['login'])){
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    
//    echo $username ;
    
    $query = "SELECT * FROM users WHERE username = '$username'";
    $results = query($query);
    
    $count = mysqli_num_rows($results);
    
    
    if($count == 0){
        echo "No user name $username";
        header("Location: ../index.php");
    }else{
        echo "found that guy $username";
        $row = mysqli_fetch_assoc($results);
        
        $user_id = $row['id'];
        $user_password = $row['password'];
        $role = $row['role'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        
        
        if($password != $user_password){
            header("Location: ../index.php");
        }else{
            
            session_start();
            $_SESSION['user_id']=$user_id;
            $_SESSION['username']=$username;
            $_SESSION['firstname']=$firstname;
            $_SESSION['lastname']=$lastname;
            $_SESSION['role']=$role;
            header("Location: ../admin");
        }
        
    }
    
}else{
    header("Location: ../index.php");
    
}

















?>