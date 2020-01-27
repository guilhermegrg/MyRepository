           <div class="col-md-4">

               
               
               
               
                <!-- Login Well -->

               
                <div class="well">
                   
                <?php if(isset($_SESSION['role'])): 
//                   $role = $_SESSION['role'];
//                   echo "<h1>$role</h1>";
               
               ?>
                 
     
                     <h4>Logged in as <?php echo $_SESSION['username']; ?> </h4>

                  
                <?php else: ?>
                   
                    <h4>Login</h4>
                    <form action="includes/login.php" method="post">
                      <div class="form-group">
                        <input name="username" type="text" class="form-control" placeholder="Enter Username">
                    </div>
                    <div class="input-group">
                        <input name="password" type="password" class="form-control" placeholder="Enter Password">
                        <span class="input-group-btn">
                            <button type="submit" name="login" value="Login" class="btn btn-primary">Login</button>
                            
                        </span>
                    </div>
                    
                    </form>
                    <!-- /.input-group -->
                    
            <?php
               endif;
               ?>
                    
                </div>



               
               
                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="post">
                    <div class="input-group">
                        <input name="search" type="text" class="form-control">
                        <span class="input-group-btn">
                            <button name="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    </form>
                    <!-- /.input-group -->
                </div>
                
                
                
                
                
                

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                               
                               
                               <?php
                                
                                include "db.php";
                                
                                
                                $query ="SELECT * FROM categories";
                                $cats = query($query);

                    
                                while($row = mysqli_fetch_assoc($cats)){
                                     $cat_id = $row['id'];
                                     $name = $row['name'];
                                        echo "<li><a href='posts_by_category.php?cat_id=$cat_id'>$name</a>";
    

                                }
                    
                                
                                
                                ?>
                               
<!--
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
-->
                                
                                
                            </ul>
                        </div>
                       
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <?php include "widget.php"; ?>
            </div>