 <form action="?update=<?php echo $id; ?>" method="post"> 
                            <div class="form-group">
                               <label for="cat_name">Edit Category Name</label>
                                <input class="form-control" type="text" name="update_cat_name" value="<?php echo $name; ?>">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="update" value="Update Category">
                            </div>

                        </form>   