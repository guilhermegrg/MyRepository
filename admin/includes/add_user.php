<?php

    include "../includes/db.php";

    if(isset($_POST['create_user'])){
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $role = $_POST['role'];

        
        $profileimage = $_FILES['profileimage']['name'];
        $profileimage_temp = $_FILES['profileimage']['tmp_name'];
        
    
        move_uploaded_file($profileimage_temp,"../images/$profileimage");
        
        
        $query = "INSERT INTO users(username, password, firstname, lastname, role, profileimage) VALUES('$username','$password','$firstname','$lastname','$role','$profileimage')";
        
        $result = query($query);
        $last_id = $conn->insert_id;
//        echo "<h1>$result</h1>";
        echo "<p class='bg-success'>User '$username' created! <a href='?source=edit_user&id=$last_id' >Edit</a> <a href='users.php' >View Users</a></p>";
        
    }




?>
   

   <form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
       <label for="username">Username</label>
        <input type="text" name="username" class="form-control"> 
    </div>
    
    <div class="form-group">
       <label for="password">Password</label>
        <input type="password" name="password" class="form-control"> 
    </div>    

    <div class="form-group">
       <label for="email">Email</label>
        <input type="email" name="email" class="form-control"> 
    </div>

    <div class="form-group">
       <label for="firstname">First Name</label>
        <input type="text" name="firstname" class="form-control"> 
    </div>
    
    <div class="form-group">
       <label for="lastname">Last Name</label>
        <input type="text" name="lastname" class="form-control"> 
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
        <input type="file" name="profileimage" class="form-control"> 
    </div>  
   <div class="form-group">
       <input type="submit" name="create_user" value="Create" class="btn btn-primary">
   </div>
            
    
</form>