   
    <?php

    include "../includes/db.php";

    if(isset($_POST['update_post'])){
        
        
        
        
        $id = $_POST['id'];
        
//        echo "<h1>POST ID = $id</h1>";
        
        
        
        
        $title = $_POST['title'];
        $author_id = $_POST['author_id'];
        $cat_id = $_POST['cat_id'];
        $status = $_POST['status'];
        $tags = $_POST['tags'];
        $content = $_POST['content'];
        $content = mysqli_real_escape_string($conn,$content);
        
         $query = "SELECT * FROM posts WHERE id=$id";
                              
            $posts = query($query);
            $row = mysqli_fetch_assoc($posts);  
        $image = $row['image'];
        
        $new_image = $_FILES['image']['name'];
        
        
        if($new_image){
            $image_temp = $_FILES['image']['tmp_name'];
            move_uploaded_file($image_temp,"../images/$new_image");
            $image = $new_image;
        }
        
        //$date = date('Y-m-d H:i:s');
        //$comment_count = 4;
        
        
        
        
//        echo $date . "<br>";
        
        $query = "UPDATE posts SET title='$title', author_id=$author_id, cat_id=$cat_id, status='$status', tags='$tags', content='$content' " ;
        
        if($new_image)
            $query .= ", image='$new_image' ";
        
        $query .= " WHERE id=$id";
        
        query($query);
//        echo "<h1>$result</h1>";
        echo "<p class='bg-success'>Post Updated! <a href='../post.php?id=$id'>View Post</a> or <a href='posts.php'>View All Posts</a></p>";
        //header("Location: posts.php");
        
        
        
    }

//    if(defined($id)){
        
        
        else if(isset($_GET['id'])){

            $id = $_GET['id'];
        
//            echo "<h1>GET ID = $id</h1>";
        
            $query = "SELECT * FROM posts WHERE id=$id";
                              
            $posts = query($query);
            $row = mysqli_fetch_assoc($posts);                  
        
            
            $author_id = $row['author_id'];
            $title = $row['title'];
            $cat_id = $row['cat_id'];
            $status = $row['status'];
            $image = $row['image'];
            $tags = $row['tags'];
            $content = $row['content'];
            $comment_count = $row['comment_count'];
            $date = $row['date'];
        
        }
    else{
        
        echo "<h1>No ID passed!!!</h1>";
        
    }




?>
<!--   <?php echo "Image: " . $image . "<br>";?>-->

   <form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
       <label for="id">Id</label>
        <input type="text" name="id" class="form-control" value="<?php echo $id; ?>" readonly="true" > 
    </div>
    
        
                
    <div class="form-group">
       <label for="title">Title</label>
        <input type="text" name="title" class="form-control" value="<?php echo $title; ?>"> 
    </div>
    
    
    
<div class="form-group">
       <label for="author">Author</label>
<!--        <input type="text" name="author" class="form-control" value="<?php echo $author; ?>"> -->
       <select name="author_id" id="">
           
   <?php

    $query = "SELECT * FROM users WHERE role='admin'";
    $results = query($query);
    while($row = mysqli_fetch_assoc($results)){
    
        $temp_author_name = $row['username'];
        $temp_author_id = $row['id'];
        
        
        if($author_id == $temp_author_id)
            echo "<option value='$temp_author_id' selected>$temp_author_name</option>";
        else
            echo "<option value='$temp_author_id' >$temp_author_name</option>";
        
    }
    

?>
           
           
           
       </select>
</div>
    
<!--

    <div class="form-group">
       <label for="author">Author</label>
        <input type="text" name="author" class="form-control" value="<?php echo $author; ?>"> 
    </div>
-->

<!--
    <div class="form-group">
       <label for="cat_id">Cat Id</label>
        <input type="text" name="cat_id" class="form-control" value="<?php echo $cat_id; ?>"> 
    </div>
-->
              
    <div class="form-group">
       <label for="cat_id">Categories</label>
       <select name="cat_id" id="">
          
           <?php
            $query ="SELECT * FROM categories";
            $cats = query($query);
           while($row = mysqli_fetch_assoc($cats)){
                        $list_cat_id = $row['id'];
                        $name = $row['name'];
                        
                if($cat_id == $list_cat_id)
                        $selected = 'selected';
               else
                   $selected = ' ';
               
                        echo "<option value='$list_cat_id' $selected >$name</option>";
           }
           
           
           ?>
           
       </select>
<!--        <?php echo $cat_id; ?>-->
    </div>
               
    <div class="form-group">
       <label for="status">Status</label>
       <select name="status" id="">
           <option value="draft" <?php echo $status == 'draft'?"selected":"";?>>Draft</option>
           <option value="published" <?php echo $status == 'published'?"selected":"";?>>Published</option>
        </select>
<!--        <input type="text" name="status" class="form-control" value="<?php echo $status; ?>"> -->
    </div>

    <div class="form-group">
       <label for="tags">Tags</label>
        <input type="text" name="tags" class="form-control" value="<?php echo $tags; ?>"> 
    </div>
    
    <div class="form-group">
       <label for="image">Image</label>
       <img width='100' src='../images/<?php echo $image; ?>' alt='image'>
       <input type="file" name="image" class="form-control" > 
    </div>  
     
     
      
    <div class="form-group">
       <label for="content">Content</label>
        <textarea class="form-control" name="content" id="editor" cols="30" rows="10"   ><?php echo $content; ?></textarea>
        <script>
                        ClassicEditor
                                .create( document.querySelector( '#editor' ) )
                                .then( editor => {
                                        console.log( editor );
                                } )
                                .catch( error => {
                                        console.error( error );
                                } );
                </script>
    </div>
    
   <div class="form-group">
       <input type="submit" name="update_post" value="Update" class="btn btn-primary">
   </div>
            
    
</form>


<?php ?>