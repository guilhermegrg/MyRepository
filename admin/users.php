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
                            Welcome to Users
                            <small>Author</small>
                        </h1>
                   
                   
                   
                   
                      
                   
                   
                   <?php 
    
                    if(isset($_GET['source'])){
                        
                        $source = $_GET['source'];
                        
                    }else{
                        $source = "";
                    }
                        switch($source){
                                
                            case 'add_user':
//                                echo "34!";
                                include "includes/add_user.php";
                            break;

                            case 'edit_user':
//                                echo "100!";
//                                $id = $_GET['id'];
//                                echo "<h1> Id on Posts.php is $id</h1><br>";
                                include "includes/edit_user.php";
                            break;
                                
                                
                            default:
//                                echo "default!";
                                include "includes/view_all_users.php";
                            break;
                        }
                    
    
    
    ?>
                  
                 
                   
                   
                   
                   
                   
                   
                   
                   
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
