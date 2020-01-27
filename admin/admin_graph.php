 <?php   
       
    function getCount($tablename,$parameter,$value){
        $query = "SELECT * FROM $tablename WHERE $parameter='$value'";
        $results = query($query);
        $count = mysqli_num_rows($results);
        return $count;
    }


    $draftpostcount = getCount("posts","status","draft");

    $pubpostcount = getCount("posts","status","published");

    $appcommentcount = getCount("comments","status","approved");

    $uncommentcount = getCount("comments","status","unapproved");

    $adminusercount = getCount("users","role","admin");               

    $subusercount = getCount("users","role","subscriber"); 

//    $query = "SELECT * FROM categories";
//    $results = query($query);
//    $catcount = mysqli_num_rows($results);

?>
                  
                  
                  <div class="row">
                   
                   <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['', 'Count'],
            
            <?php
            
$map = ['All Posts' => $postcount, 'Published Posts'=>$pubpostcount, 'Draft Posts' => $draftpostcount, 'All Comments' => $commentcount, 'Approved Comments' => $appcommentcount, 'Unapproved Comments' => $uncommentcount, 'All Users' => $usercount, 'Subscribers'=>$subusercount, 'Admins'=>$adminusercount, 'Categories' => $catcount];
foreach($map as $key => $value){
    echo "['$key',$value],";
}            
               
            
//as two arrays
//                $tags = ['Posts',"Comments","Users","Categories"];
//                $counts = [$postcount,$commentcount,$usercount,$catcount];
//
//
//                for($i=0;$i<4;++$i){
//                    echo "['$tags[$i]', $counts[$i]],";
//                }
            
            
//as an assoc array or map
//$map = ['Posts' => $postcount,'Comments' => $commentcount,'Users' => $usercount,'Categories' => $catcount];
//foreach($map as $key => $value){
//    echo "['$key',$value],";
//}            
//            
            
//                echo "]);"
            ?>
            
//          ['Posts', <?php  echo $postcount; ?>],
//          ['Comments', <?php  echo $commentcount; ?>],
//          ['Users', <?php  echo $usercount; ?>],
//          ['Categories', <?php  echo $catcount; ?>]
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
                   <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
               </div>