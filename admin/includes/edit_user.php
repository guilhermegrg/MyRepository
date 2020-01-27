<?php

    include "../includes/db.php";

    if(isset($_POST['update_user'])){
        
        $id=$_GET['id'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $role = $_POST['role'];
        $active_value = $_POST['active'];
        
        
        $profileimage = $_FILES['profileimage']['name'];
        if($profileimage){
            $profileimage_temp = $_FILES['profileimage']['tmp_name'];
            move_uploaded_file($profileimage_temp,"../images/$profileimage");
        }else{
            $query = "SELECT * FROM users WHERE id=$id";
            $posts = query($query);
            $row = mysqli_fetch_assoc($posts); 
            
            $profileimage = $row['profileimage'];
        }

        
        
        

        if(!empty($password)){
                $hashed_password = password_hash($password,PASSWORD_DEFAULT);
//                echo "Passes: $password -> $hashed_password<br>";
        }else{
            $query = "SELECT password FROM users WHERE id=$id";
            $results = query($query);
            $row = mysqli_fetch_assoc($results);
            $password = $row['password'];
            
            $hashed_password = $password;
//            echo "Passes 2: $password -> $hashed_password<br>";
        }
        
        $query = "UPDATE users SET username='$username', password='$hashed_password', email='$email', firstname='$firstname', lastname='$lastname', role='$role' " ;
        
        if($profileimage)
            $query .= ", profileimage='$profileimage' ";
        
        $query .= " WHERE id=$id";
        
        query($query);
//        echo "<h1>$result</h1>";
        
         echo "<p class='bg-success'>User '$username' Updated! <a href='users.php?source=edit_user&id=$id'>Edit User</a> or <a href='users.php'>View All Users</a></p>";
        
        header("Location: users.php");
        
        
        
    }

//    if(defined($id)){
        
        
        else if(isset($_GET['id'])){

            $id = $_GET['id'];
        
            echo "<h1>$id</h1>";
        
            $query = "SELECT * FROM users WHERE id=$id";
                              
            $posts = query($query);
            $row = mysqli_fetch_assoc($posts);                  
        
            
//           $id = $row['id'];
            $username = $row['username'];
            $password = $row['password'];
            $email = $row['email'];
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $active = $row['active'];
            $role = $row['role'];
            $profileimage = $row['profileimage'];
            //                                      $date = $row['date'];

            $active_value = $active?"true":"false";
        
        }



    else{
        
        echo "<h1>No ID passed!!!</h1>";
        
    }




?>
   

   <form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
       <label for="id">Id</label>
        <input type="text" name="id" class="form-control" value="<?php echo $id; ?>" readonly="true" > 
    </div>
    
    <div class="form-group">
       <label for="tags">Username</label>
        <input type="text" name="username" class="form-control" value="<?php echo $username; ?>"> 
    </div>

    <div class="form-group">
       <label for="tags">Password</label>
        <input  autocomplete="off" type="password" name="password" class="form-control" > 
    </div>
    
       
   <div class="form-group">
       <label for="tags">Email</label>
        <input type="email" name="email" class="form-control" value="<?php echo $email; ?>"> 
    </div>

       
    <div class="form-group">
       <label for="tags">First Name</label>
        <input type="text" name="firstname" class="form-control" value="<?php echo $firstname; ?>"> 
    </div>
      
    <div class="form-group">
       <label for="tags">Last Name</label>
        <input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>"> 
    </div>
     
    <div class="form-group">
       <label for="tags">Role</label>
       <select name="role">
           <option value="admin" <?php echo $role=="admin"?"selected":""; ?> >Admin</option>
           <option value="subscriber" <?php echo $role=="subscriber"?"selected":""; ?> >Subscriber</option>
       </select>
    </div>
      
      <div class="form-group">
       <label for="tags">Active</label>
        <input type="text" name="active" class="form-control" value="<?php echo $active_value; ?>" readonly="true"> 
    </div>     
        
                
    <div class="form-group">
       <label for="image">Image</label>
       <img width='100' src='../images/<?php echo $profileimage; ?>' alt='image'>
       <input type="file" name="profileimage" class="form-control" > 
    </div>  
     
     

    
   <div class="form-group">
       <input type="submit" name="update_user" value="Update" class="btn btn-primary">
   </div>
            
    
</form>


<?php ?>