$(document).ready(function(){
    
//    alert('Hello!');
    $('#selectAllBoxes').click(function(event){
        
        var checkValue = this.checked ;
        
        $('.checkBoxes').each(function(){
            this.checked = checkValue;
            
            
            
        });
        
        
    });
    
    
    var div_box = "<div id='load-screen'><div id='loading'></div></div>";
    $("body").prepend(div_box);
    $('#load-screen').delay(300).fadeOut(200, function(){
        $(this).remove();
    })
    
});


function loadUsersOnline(){
    
    $.get("functions.php?getonlineusers=result", function(data){
        
        $(".usersonline").text(data);
        
    });
    
};


setInterval(function(){
    
    loadUsersOnline();
    
},500);
