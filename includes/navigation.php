<?php include "db.php" ?>
       

       <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            
               <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">CMS Frontend</a>
            </div>
            
            
            
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                   
                   
                   
                   <?php
    
    
                    $pagename = basename($_SERVER['PHP_SELF']);

//                    echo "<h1>$pagename</h1>";

                    $category_selection_style="";
                    $admin_selection_style="";
                    $registration_selection_style="";
                    $contact_selection_style="";

                    
                    switch($pagename){
                        case "posts_by_category.php":
                            $category_selection_style="active";
                        break;
                            
                        case "registration.php":
                            $registration_selection_style="active";
                        break;
                            
                        case "contact.php":
                            $contact_selection_style="active";
                        break;

                            
                    }

    
    
//                    echo "<h1>Cat: $category_selection_style</h1>";
//                    echo "<h1>Register: $registration_selection_style</h1>";
//                    echo "<h1>Contact: $contact_selection_style</h1>";
//                    echo "<h1>Admin: $admin_selection_style</h1>";

    
                    $selected_cat_id = 0;
                    if(isset($_GET['cat_id'])){
                        $selected_cat_id = mysqli_real_escape_string($conn,trim($_GET['cat_id']));
                    }
                    
                    $query ="SELECT * FROM categories";
                    $cats = query($query);

                    
                    while($row = mysqli_fetch_assoc($cats)){
                        $cat_id = $row['id'];
                        $name = $row['name'];
                        
                        
                        $style="";
                        if($selected_cat_id == $cat_id)
                            $style=$category_selection_style;
                        
                        echo "<li class='$style' ><a href='posts_by_category.php?cat_id=$cat_id' >$name</a>";
    
                    }
                    
                    ?>
                   
                   <li <?php echo "class='$admin_selection_style'"; ?> >
                        <a  href="admin">Admin</a>
                    </li>
                    
                    
                     <li <?php echo "class='$registration_selection_style'"; ?> >
                        <a   href="registration.php">Register</a>
                    </li>
                    
                    <li <?php echo "class='$contact_selection_style'"; ?> > 
                        <a  href="contact.php">Contact</a>
                    </li>
                   
<!--
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
-->
                    
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
