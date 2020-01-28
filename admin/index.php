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



<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

<?php include "includes/footer.php" ?>
  
  <?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    require $path.'/cms/vendor/autoload.php';


    $dotenv = Dotenv\Dotenv::createImmutable($path.'/cms/');
    $dotenv->load();
    $pusher_key= getenv('PUSHER_KEY');
    ?>

  <script src="https://js.pusher.com/5.0/pusher.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  
  <script>
//      Pusher.logToConsole = true;
      
      $(document).ready(function(){
          
          
            var pusher_key = <?php echo json_encode($pusher_key); ?>;
            console.log(pusher_key);
            
            var pusher = new Pusher(pusher_key, {
            cluster: 'eu',
            forceTLS: true
            });

            var channel = pusher.subscribe('admin_notifications');
            channel.bind('new_user', function(data) {
//                console.log(data.message);
//                alert(JSON.stringify(data.message));
                
                toastr.success(data.message);
            });    
          
          
          
      });






  </script>
