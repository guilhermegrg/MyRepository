<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<?php



        if(IfItIsMethod('get') && isset($_GET['email']) && isset($_GET['token'])){
            
            $email=$_GET['email'];
            $token = $_GET['token'];
            
            $email = escape($email);
            $token = escape($token);
            
            $id = getUserByEmail($email);
            if($id>0){
//                echo "<h2>Error fetching the user: $email - $token</h2>";
                
            }else{
                redirect("/cms/index");
            }   
                
            
            
        }elseif(IfItIsMethod('post') && isset($_POST['password']) && isset($_POST['repeat_password']) && isset($_POST['email']) && isset($_POST['token'])){
            
            $password = $_POST['password'];
            $repeat_password = $_POST['repeat_password'];
            $email=$_POST['email'];
            $token = $_POST['token'];
            
            $password = escape($password);
            $repeat_password = escape($repeat_password);
            $email = escape($email);
            $token = escape($token);
            
            
            if($password != $repeat_password){
                echo "<p class='bg-danger'>Passwords don't match! They must be equal!</p>";
            }else{
            
                $id = getUserByEmail($email);
                if($id>0){

                    $query = "SELECT token FROM users WHERE id = ?";
                    $stmt = mysqli_prepare($conn,$query);
                    mysqli_stmt_bind_param($stmt,"i",$id);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    mysqli_stmt_bind_result($stmt, $stored_token);

                    $count = mysqli_stmt_num_rows($stmt); 

                    if($count == 0){
                        mysqli_stmt_close($stmt);
                        echo "<h2>Error fetching the user: $email - $count</h2>";
                    }else{
                        mysqli_stmt_fetch($stmt);
                        if($token === $stored_token){
                            
                            $hashed_password = password_hash($password,PASSWORD_DEFAULT);
                            
                            
                            
                            $query = "UPDATE users SET password= ? , token='' WHERE id=?";
                            $stmt = mysqli_prepare($conn,$query);
                            mysqli_stmt_bind_param($stmt,"si",$hashed_password,$id);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_store_result($stmt);
                            
                            redirect("/cms/login"); 
                            
                        }else
                        {
                            redirect("/cms/index");       
                        }
                    }

                }else{
                    redirect("/cms/index");
                }   

            }
        }else{
//            echo "<h2>Nada de jeito!</h2>";
            redirect("/cms/index");
        }
        





?>

<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">

                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post" action="">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="password" name="password" placeholder="Type your password" class="form-control"  type="password">
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="repeat_password" name="repeat_password" placeholder="Confirm your password" class="form-control"  type="password">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="<?php echo $token; ?>">
                                        <input type="hidden" class="hide" name="email" id="email" value="<?php echo $email; ?>">
                                    </form>

                                </div><!-- Body-->

<!--                                <h2>Please check your email</h2>-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->

