
   
<?php

    include "../includes/db.php";

    if(isset($_POST['create_post'])){
        
        
        
        $title = $_POST['title'];
        $author = $_POST['author'];
        $cat_id = $_POST['cat_id'];
        $status = $_POST['status'];
        $tags = $_POST['tags'];
        $content = $_POST['content'];
        $content = mysqli_real_escape_string($conn,$content);
        
        $image = $_FILES['image']['name'];
        $image_temp = $_FILES['image']['tmp_name'];
        
        $date = date('Y-m-d H:i:s');
        $comment_count = 0;
        
        move_uploaded_file($image_temp,"../images/$image");
        
        
        echo $date . "<br>";
        
        $query = "INSERT INTO posts(title,author,cat_id,status,tags,content,image,date,comment_count) VALUES('$title','$author',$cat_id,'$status','$tags','$content','$image','$date',$comment_count)";
        
        query($query);
//        echo "<h1>$result</h1>";
         $last_id = $conn->insert_id;
//        echo "<h1>$result</h1>";
//        echo "<p class='bg-success'>Post $last_id created! <a href='?source=edit_post&id=$last_id' >Edit</a> <a href='posts.php' >View Posts</a></p>";
        echo "<p class='bg-success'>Post $last_id created! <a href='../post.php?id=$last_id'>View Post</a> or <a href='posts.php'>View All Posts</a></p>";
        
    }




?>
   

   <form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
       <label for="title">Title</label>
        <input type="text" name="title" class="form-control"> 
    </div>

    <div class="form-group">
       <label for="author">Author</label>
        <input type="text" name="author" class="form-control"> 
    </div>


 <div class="form-group">
       <label for="cat_id">Category</label>
       <select name="cat_id" id="">
          
           <?php
            $query ="SELECT * FROM categories";
            $cats = query($query);
           while($row = mysqli_fetch_assoc($cats)){
                        $list_cat_id = $row['id'];
                        $name = $row['name'];
               
                        echo "<option value='$list_cat_id' >$name</option>";
           }
           
           
           ?>
           
       </select>
</div>
<!--
    <div class="form-group">
       <label for="cat_id">Cat Id</label>
        <input type="text" name="cat_id" class="form-control"> 
    </div>
-->
               
    <div class="form-group">
       <label for="status">Status</label>
        <select name="status" id="">
           <option value="draft" selected>Draft</option>
           <option value="published" >Published</option>
        </select>
    </div>

    <div class="form-group">
       <label for="tags">Tags</label>
        <input type="text" name="tags" class="form-control"> 
    </div>
    
    <div class="form-group">
       <label for="image">Image</label>
        <input type="file" name="image" class="form-control"> 
    </div>  
     
     
      
    <div class="form-group">
       <label for="content">Content</label>
        <textarea class="form-control" name="content" id="editor" cols="30" rows="10"></textarea>
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
       <input type="submit" name="create_post" value="Create" class="btn btn-primary">
   </div>
            
    
</form>