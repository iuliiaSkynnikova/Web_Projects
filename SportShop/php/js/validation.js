$(function () {
    $('#contactUs').validate({
        rules: {
            firstname: {
                required:true,
                minlength:2
            },

            lastname:{
                required:true,
                minlength:2
            },
           
            phone:{
                required:true,
                mobileAU:true
            },

            email:{
                required:true,
                email:true
            },
            
            question:"required", 

            address:"required",       
        },

        messages: {
            firstname:{
                required: "Please enter your First name",
                minlength: "Your first name must consist of at least 2 characters"
            },
            lastname:{
                required: "Please enter your Last name",
                minlength: "Your last name must consist of at least 2 characters"
            },
            
            phone:"Please enter your Australian phone number",
            email:"Please enter valid Email address",
            question:"Please enter your question",
            address:"Please enter your Delivery address"
        }
    });
    jQuery.validator.addMethod( "mobileAU", function( phone_number, element ) {
        phone_number = phone_number.replace( /\(|\)|\s+|-/g, "" );
        return this.optional( element ) || phone_number.length > 9 &&
            phone_number.match( /^\({0,1}((0|\+61)(2|4|3|7|8)){0,1}\){0,1}(\ |-){0,1}[0-9]{2}(\ |-){0,1}[0-9]{2}(\ |-){0,1}[0-9]{1}(\ |-){0,1}[0-9]{3}$/ );
    }, "Please specify a valid phone number" );

     jQuery.validator.addMethod( "email", function( value, element ) {
        return this.optional( element )||
            value.match( /^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/ );
    }, "Please enter a valid email" );
});