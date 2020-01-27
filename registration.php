<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
   
   
   <?php 


     $username ="";
        $password  ="";
        $email  ="";

    $message ="";

    if(isset($_POST['submit'])){
        
        $username = $_POST['username'];
        $password =  $_POST['password'];
        $email = $_POST['email'];
        
        if(!empty($username) && !empty($password) && !empty($email) ){
            
            
        $username = mysqli_real_escape_string($conn,trim($username));
        $password = mysqli_real_escape_string($conn,trim($password));
        $email = mysqli_real_escape_string($conn,trim($email));
            
        $validation = true; 
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
            $password = password_hash($password,PASSWORD_DEFAULT);

    //        echo "$username - $password - $email";


            $query = "INSERT INTO users(username, password, email, role) VALUES( '$username', '$password', '$email','')";
            $result = query($query);

            $message = "<p class='bg-success'>Your registration has been submitted!</p>";
            
            $username ="";
            $password  ="";
            $email  ="";


        }
            
        }else{
        $message = "<p class='bg-danger'>Fields can't be empty !</p>";
        }
    }




    ?>
   
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                       
                       <h6 class="text-center"><?php echo $message; ?></h6>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" value='<?php echo $username; ?>' autocomplete="on" >
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" value='<?php echo $email; ?>'  autocomplete="on" >
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password" value='<?php echo $password; ?>'>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
