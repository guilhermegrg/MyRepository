<?php include "includes/header.php" ?>

    <div id="wrapper">

        <!-- Navigation -->
    <?php include "includes/navigation.php" ?>
        
        
        <?php
    
    
//    if(isset($_GET['delete'])){
//        
//        $delete_id = $_GET['delete'];
//        
//        $query = "DELETE FROM categories WHERE id=$delete_id";
//        $result = query($query);
//        
//        if(!$result){
//            echo "Error deleting category $delete_id " . mysqli_error($conn);
//        }
//        
//        
//    }
    
    
    ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Categories
                            <small>Author</small>
                        </h1>
                        
                        <div class="col-xs-6">
                        
                        
                        <?php
                        
                        insertCategories();
                        
                        
                        ?>
                        
                        <form action="" method="post">
                            <div class="form-group">
                               <label for="cat_name">Category Name</label>
                                <input class="form-control" type="text" name="cat_name">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary"type="submit" name="submit" value="Add Category">
                            </div>

                        </form>
                        
                        <?php

                            include "edit_category.php";
                            
                            
                            
                            
                        ?>                            

                        
                        </div>
                        
                        <div class="col-xs-6">
                        
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                               <?php
                                
                                //fetch query
                                showAllCategories();
    ?>
                     <?php
                                //delete
                                deleteCategory();
                                
                                ?>
                               

                            </tbody>
                        </table>
                        
                        </div>
                        
                        
                       
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
