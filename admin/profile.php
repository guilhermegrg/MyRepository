<?php include "includes/header.php" ?>

    <div id="wrapper">

        <!-- Navigation -->
    <?php include "includes/navigation.php" ?>
        
        
        <?php
    
    
    ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">

                       <h1 class="page-header">
                            Welcome to profile
                            <small>Author</small>
                        </h1>
     
                   
                   <?php 
    
    if(isset($_POST['update_user'])){
        
        $id=$_SESSION['user_id'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        //$role = $_POST['role'];
        
        
        $profileimage = $_FILES['profileimage']['name'];
        if($profileimage){
            $profileimage_temp = $_FILES['profileimage']['tmp_name'];
            move_uploaded_file($profileimage_temp,"../images/$profileimage");
        }

        
        
        
//        echo $date . "<br>";
        
        $query = "UPDATE users SET username='$username', password='$password', email='$email', firstname='$firstname', lastname='$lastname' " ;
        
        if($profileimage)
            $query .= ", profileimage='$profileimage' ";
        
        $query .= " WHERE id=$id";
        
        query($query);
//        echo "<h1>$result</h1>";
        
     //   header("Location: index.php");
        
        
        
    }
    
     //              echo "<h1>READING VALUES FROM DATABASE!</h1><br>" ;
                    
            $id = $_SESSION['user_id'];
        
//        echo "<h1>ID is $id</h1><br>" ;
        
//            echo "<h1>$id</h1>";
        
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
        <input type="password" name="password" class="form-control" value="<?php echo $password; ?>"> 
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
        <input type="text" name="Role" class="form-control" value="<?php echo $role; ?>" readonly="true" > 
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
       <input type="submit" name="update_user" value="Update Profile" class="btn btn-primary">
   </div>
            
    
</form>
                    
       
    
    
                  
                 
                   
                   
                   
                   
                   
                   
                   
                   
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->



<?php include "includes/footer.php" ?>
