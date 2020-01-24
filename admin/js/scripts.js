$(document).ready(function(){
    
//    alert('Hello!');
    $('#selectAllBoxes').click(function(event){
        
        var checkValue = this.checked ;
        
        $('.checkBoxes').each(function(){
            this.checked = checkValue;
            
            
            
        });
        
        
    });
    
    
    
    
});