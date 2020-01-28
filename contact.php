<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>
 <?php  include "admin/email.php"; ?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
   
   
   <?php 

    $message ="";

    if(isset($_POST['submit'])){
        
        $subject = $_POST['subject'];
        $content =  $_POST['content'];
        $email = $_POST['email'];
        
        if(!empty($subject) && !empty($content) && !empty($email)){
            
            
            $subject = mysqli_real_escape_string($conn,trim($subject));
            $content = mysqli_real_escape_string($conn,trim($content));
            $email = mysqli_real_escape_string($conn,trim($email));

            
            sendBasicEmail("guilhermegrg@gmail.com",$email,$subject,$content);
//            mail("guilhermegrg@gmail.com",$subject,$content,$header);
            
            
            $message = "<p class='bg-success'>Your message has been submitted!</p>";
        
            
            
        }else{
            $message = "<p class='bg-danger'>Fields can't be empty !</p>";
        }
        
        echo $message;
    }




    ?>
   
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="contact.php" method="post" id="contact-form" autocomplete="off">
                       
                       <h6 class="text-center"><?php echo $message; ?></h6>
                        <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter Subject">
                        </div>
                        
                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email">
                        </div>
                        
                        <div class="form-group">
                            <label for="content" class="sr-only">Message</label>
                            <textarea class="form-control" name="content" id="content" cols="30" rows="10"></textarea>
                        </div>

                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Send Message">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->


        <hr>



<?php include "includes/footer.php";?>
