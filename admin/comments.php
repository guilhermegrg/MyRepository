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
                            Welcome to Comments
                            <small>Author</small>
                        </h1>
                   
                   
                   
                   
                      
                   
                   
                   <?php 
    
                    if(isset($_GET['source'])){
                        
                        $source = $_GET['source'];
                        
                    }else{
                        $source = "";
                    }
                        switch($source){
                                
                            case 'add_post':
//                                echo "34!";
                                include "includes/add_post.php";
                            break;

                            case 'edit_post':
//                                echo "100!";
//                                $id = $_GET['id'];
//                                echo "<h1> Id on Posts.php is $id</h1><br>";
                                include "includes/edit_post.php";
                            break;
                                
                                
                            default:
//                                echo "default!";
                                include "includes/view_all_comments.php";
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
