<?php include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>

  
<?php

if(isset($_POST['like'])){
    
    $like =$_POST['like'];
    $post_id =$_POST['post_id'];
    $user_id =$_POST['user_id'];
    
    echo "Like: $like Post: $post_id User: $user_id";
    
    if(!empty($like) && !empty($post_id) && !empty($user_id)){

        if($like == 1){
        
            $query = "UPDATE posts SET like_count = like_count + 1 WHERE id=$post_id";
            query($query);

            $date = time();

            $query = "INSERT INTO likes(post_id, user_id, date) VALUES ($post_id, $user_id, '$date') ";
            query($query);
            
        }elseif($like == -1){

            $query = "UPDATE posts SET like_count = like_count - 1 WHERE id=$post_id";
            query($query);

            $query = "DELETE FROM likes WHERE post_id = $post_id AND  user_id=$user_id";
            query($query);

        }

    }
    
}
else
if(isset($_GET['id'])){
    $id = $_GET['id'];
    
    $query = "UPDATE posts SET views = views + 1 WHERE id=$id";
    $result = query($query);
    
    
    
    if(isset($_SESSION['role'])){
        $role = $_SESSION['role'];
        if($role == 'admin'){
            $published_query =  "";
        }else{
                $published_query =  " AND status='published'";
        }
    }else{
        $published_query =  " AND status='published'";
    }
    
    
    $query = "SELECT * FROM posts WHERE id=$id $published_query";
                              
    $posts = query($query);
    $row = mysqli_fetch_assoc($posts);                  

    if(mysqli_num_rows($posts) == 0){
        echo "<h2>No posts!</h2>";
        header("Location: index.php");
    }else{
    

        $author_id = $row['author_id'];
        $title = $row['title'];
        $cat_id = $row['cat_id'];
        $status = $row['status'];
        $image = $row['image'];
        $tags = $row['tags'];
        $content = $row['content'];
        $comment_count = $row['comment_count'];
        $date = $row['date'];




        if(!$author_id){
            $author_name = "NOT DEFINED";
        }else{
            $query = "SELECT * FROM users WHERE id=$author_id";
            $results = query($query);
            $row = mysqli_fetch_assoc($results);

            $author_name = $row['username'];
        }

    }

}

?>
    

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo $title; ?></h1>

                <!-- Author -->
                <?php if($author_id){ ?>
                <p class="lead">
                    by <a href="/cms/author/<?php echo $author_id; ?>"><?php echo $author_name; ?></a>
                </p>
                <?php } ?>
               
                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $date; ?></p>

               
               <?php

                    if(isset($_SESSION['role']))
                       {
                           $role = $_SESSION['role'];
                           if($role == 'admin'){
                               
                               ?>
                               
                            <p class="lead"><a href="admin/posts.php?source=edit_post&id=<?php echo $id; ?>">Edit Post</a></p>
                               
                               
                               <?php
            
                            }
                       }

                ?>
               
                <hr>

                <!-- Preview Image -->
                
                <?php if(!isset($image) || empty($image)): ?> 
                    <img class="img-responsive" src="/cms/images/CF_Hierarchy_new1.png" alt="">
                <?php else: ?>
                    <img class="img-responsive" src="/cms/images/<?php echo $image; ?>" alt="">                
                <?php endif; ?>
                
                
                

                <hr>

                <!-- Post Content -->
                <p class="lead"><?php echo $content; ?></p>

                <hr>

              <!-- Likessssss -->
              
              <?php if(isLoggedIn()) : ?>
               <div class="row" >
                   
                      <?php if(isPostLiked($id)) : ?>
                          <p class="pull-right" data-toggle="tooltip" data-placement="top" title="I liked this before">
                           <a class="unlike" href=""><span class="glyphicon glyphicon-thumbs-down" ></span>Unlike</a>
                           </p>
                      <?php else: ?>
                          <p class="pull-right" data-toggle="tooltip" data-placement="top" title="Want to like it?">
                           <a class="like" href=""><span class="glyphicon glyphicon-thumbs-up"></span>Like</a>
                           </p>
                      <?php endif; ?>
                   
               </div>
               <?php else: ?>
                <div class="row">
                    <p class="pull-right">You need to <a href="/cms/login">login</a> to like</p>    
                </div>
               <?php endif; ?>
               
               
               <div class="row">
                   <p class="pull-right" >Likes: <?php echo getPostLikes($id); ?></p>
               </div>
               
               <hr>
               
                <!-- Blog Comments -->

                

               <?php include "includes/comments.php"; ?>
               
            </div>
            <!-- Blog Sidebar Widgets Column -->
          <?php include "includes/sidebar.php"; ?>  
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php"; ?>

<script>
            
            
    $(document).ready(function(){
        
        
            $("[data-toggle='tooltip']").tooltip();
       
            $(".like").click(function(){
//               alert("like!");
//               console.log("like!");
                var post_id = <?php echo $id; ?>;
                var user_id = <?php echo getUserId(); ?>;

                console.log("Post: " + post_id + " User:" + user_id);

                $.ajax({
                    url:"/cms/post.php?id="+post_id,
                    type:'post',
                    data: {
                        'like':1,
                        'post_id': post_id,
                        'user_id': user_id
                    }


                });

            });
        
            $(".unlike").click(function(){
//           alert("Unlike!");
//           console.log("Unlike!!!");
            var post_id = <?php echo $id; ?>;
            var user_id = <?php echo getUserId(); ?>;
            
            console.log("Post: " + post_id + " User:" + user_id);
            
            $.ajax({
                url:"/cms/post.php?id="+post_id,
                type:'post',
                data: {
                    'like':-1,
                    'post_id': post_id,
                    'user_id': user_id
                }
                
                
            });
            
        });

        
        });
    
    
            
            
            
</script>
