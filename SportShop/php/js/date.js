$(function(){

    setInterval(function(){
        var date = new Date();
        $('#datetime').text(date.getDate() + "/" + date.getMonth() + "/" + date.getFullYear() + " "
        + date.getHours() + ":" + date.getMinutes());
    }, 1000);



    $('.searchButton').click(function(e){
		if ($('#search')[0].value.trim() == ''){
			e.preventDefault();
    	}
    });



    $('.linkDelete').click(function(){
        if (!confirm("Do you want to delete?")) {
            return false; 
        } 
    });

       

});
