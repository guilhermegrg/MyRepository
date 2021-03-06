<?php

    include "../includes/db.php";

        $username = "";
        $password =  "";
        $email =  "";
        $firstname =  "";
        $lastname =  "";
        $role =  "";

    if(isset($_POST['create_user'])){
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $role = $_POST['role'];
        
        
        $validation = true;
        if(empty($username) || empty($password) || empty($email)){
            echo "<p class='bg-danger'>Fields can't be empty! </p>";
            $validation = false;
        }

        if(isUsernameRegistered($username))
        {
            echo "<p class='bg-danger'>Username '$username' already exists! Pick another! </p>";
            $validation = false;
        }
        
        if(isEmailRegistered($email))
        {
            echo "<p class='bg-danger'>Email '$email' already exists! Pick another! </p>";
            $validation = false;
        }
        
        
        if($validation){
            $username = mysqli_real_escape_string($conn,$username);
            $password = mysqli_real_escape_string($conn,$password);
            $email = mysqli_real_escape_string($conn,$email);

            $password = password_hash($password,PASSWORD_DEFAULT);


            $profileimage = $_FILES['profileimage']['name'];
            $profileimage_temp = $_FILES['profileimage']['tmp_name'];


            move_uploaded_file($profileimage_temp,"../images/$profileimage");


            $query = "INSERT INTO users(username, password, email, firstname, lastname, role, profileimage) VALUES('$username','$password', '$email', '$firstname','$lastname','$role','$profileimage')";

            $result = query($query);
            $last_id = $conn->insert_id;
    //        echo "<h1>$result</h1>";
            echo "<p class='bg-success'>User '$username' created! <a href='?source=edit_user&id=$last_id' >Edit</a> <a href='users.php' >View Users</a></p>";
        }
        
    }




?>
   

   <form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
       <label for="username">Username</label>
        <input type="text" name="username" class="form-control" value="<?php echo $username; ?>"> 
    </div>
    
    <div class="form-group">
       <label for="password">Password</label>
        <input type="password" name="password" class="form-control" value="<?php echo $password; ?>"> 
    </div>    

    <div class="form-group">
       <label for="email">Email</label>
        <input type="email" name="email" class="form-control" value="<?php echo $email; ?>"> 
    </div>

    <div class="form-group">
       <label for="firstname">First Name</label>
        <input type="text" name="firstname" class="form-control" value="<?php echo $firstname; ?>"> 
    </div>
    
    <div class="form-group">
       <label for="lastname">Last Name</label>
        <input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>"> 
    </div>

    <div class="form-group">
       <label for="role">Role</label>
       <select name="role">
           <option value="admin">Admin</option>
           <option value="subscriber">Subscriber</option>
       </select>
<!--        <input type="text" name="role" class="form-control"> -->
    </div>


    <div class="form-group">
       <label for="image">Image</label>
        <input type="file" name="profileimage" class="form-control" value="<?php echo $image; ?>"> 
    </div>  
   <div class="form-group">
       <input type="submit" name="create_user" value="Create" class="btn btn-primary">
   </div>
            
    
</form>