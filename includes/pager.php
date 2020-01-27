                <ul class="pager">
                    <?php 
                    $last_page_index = $start_index + ($page-1)*$posts_per_page;
                    if($last_page_index<$post_count)
                    {
                    ?>
                    <li class="previous">
                        <a href="?page=<?php echo $page+1; ?>">&larr; Older</a>
                    </li>
                    <?php } ?>
                    
                    <?php 
                    if($page>1)
                    {
                    ?>
                    <li class="next">
                        <a href="?page=<?php echo $page-1; ?>">Newer &rarr;</a>
                    </li>
                    <?php } ?>
                </ul>

                <ul class="pager">
                <?php
                    
                    for($i=1;$i<=$page_count;$i++){
                        $style="";
                        if($i == $page){
                            $style="class='active_link'";
                        }
                        echo "<li><a $style href='?page=$i'>$i</a><li>";
                    }    
                    
                    
                    ?>
                </ul>  