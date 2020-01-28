<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php  include "admin/email.php"; ?>

<?php

    $sentEmail = false;
    if(IfItIsMethod('post')){

        if(isset($_POST['email'])){
            $email = $_POST['email'];
            
            $email = mysqli_real_escape_string($conn,trim($email));
            
            $user_id = getUserByEmail($email);
            if($user_id <= 0)
//                echo "<h1>No user with the email $email was found! </h1>";
                redirect("/cms/index");
            else{
//                echo "<h1>Found as user with email $email! </h1>";
                $token = getToken();
//                echo "<h1>Token: $token</h1>";
                
                insertTokenInUserById($user_id,$token);
                sendBasicEmail("guilhermegrg@gmail.com",$email,"Recover password","Follow this link: <a href='http://localhost/cms/reset.php?email=$email&token=$token'>Recover My Pasword!</a>");
                
                $sentEmail = true;
            }
            
        }else{
//              echo "<h1>No post email </h1>";
            redirect("/cms/index");
        }

    }else if(IfItIsMethod('get') && $_GET['token']){
//        redirect("/cms/index");
    }else{
//          echo "Invalid access!! </h1>";
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


                               <?php if(!$sentEmail): ?>
                               
                               
                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">


                                

                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post" action="">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->
                                <?php else: ?>
                                    <h3>Please check your email !</h3>
                                <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->

