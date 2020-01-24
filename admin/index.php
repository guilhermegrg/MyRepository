<?php include "includes/header.php" ?>

    <div id="wrapper">

        <!-- Navigation -->
    <?php include "includes/navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>
                       
                    </div>
                </div>
                <!-- /.row -->

                
                
                <?php include "admin_widgets.php"; ?>
                <?php include "admin_graph.php"; ?>

              
           
           
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->



<?php include "includes/footer.php" ?>
