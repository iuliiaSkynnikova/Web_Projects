'use strict';

var form = document.getElementById("formLog");

form.addEventListener('submit', validateFormLog);

function validateFormLog(event) {

	var username = document.getElementById("username");
	var password = document.getElementById("password");

	var errorUsername = document.getElementById("errorUsername");
	var errorPassword = document.getElementById("errorPassword");

	errorUsername.style.display = 'none';
	errorPassword.style.display = 'none';

	if (username.value.trim().length < 5 || username.value.trim().length >30 ){
		event.preventDefault();
		errorUsername.style.display =  'initial';
	}


    var passwordlVal = password.value;
	var charDigit = /[0-9]/; 
 	var charLetter = /[a-zA-Z]/;
 	var charSpecial = /[!@#$%^&*? ,.]/;
 	

 		 if (!(charDigit.test(passwordlVal) && charLetter.test(passwordlVal) && charSpecial.test(passwordlVal) && passwordlVal.trim().length >6 )) { 
		 	 
		 	 event.preventDefault();
			 errorPassword.style.display = 'initial';
		 }

}



  		 



