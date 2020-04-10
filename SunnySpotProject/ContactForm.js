'use strict';

var form = document.getElementById("formLog");

form.addEventListener('submit', validateFormLog);

function validateFormLog(event) {

	var firstname = document.getElementById("firstname");
	var lastname = document.getElementById("lastname");
	var email = document.getElementById("email");
	var phone = document.getElementById("phone");
	var mobile = document.getElementById("mobile");
	var age = document.getElementsByName("age");
	
	var errorFirstname = document.getElementById("errorFirstname");
	var errorLastname = document.getElementById("errorLastname");
	var errorEmail = document.getElementById("errorEmail");
	var errorPhone = document.getElementById("errorPhone");
	var errorMobile = document.getElementById("errorMobile");
	var errorAge = document.getElementById("errorAge");


	errorFirstname.style.display ='none';
	errorLastname.style.display ='none';
	errorEmail.style.display ='none';
	errorPhone.style.display = 'none';
	errorMobile.style.display ='none';
	errorAge.style.display ='none';
	

	if (firstname.value.trim().length < 2) {
		event.preventDefault();
		errorFirstname.style.display = 'initial';
	}

	if (lastname.value.trim().length < 2) {
		event.preventDefault();
		errorLastname.style.display = 'initial';
	}


	var emailVal = email.value.trim();
	var emailPattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

		if (!emailPattern.test(emailVal)) {
		event.preventDefault();
		errorEmail.style.display = 'initial';
	}

	var phoneVal = phone.value.trim();
	var phonePattern = /^\({0,1}((0|\+61)(2|4|3|7|8)){0,1}\){0,1}(\ |-){0,1}[0-9]{2}(\ |-){0,1}[0-9]{2}(\ |-){0,1}[0-9]{1}(\ |-){0,1}[0-9]{3}$/;
	var mobileVal = mobile.value.trim();
	var mobilePattern = /^\({0,1}((0|\+61)(2|4|3|7|8)){0,1}\){0,1}(\ |-){0,1}[0-9]{2}(\ |-){0,1}[0-9]{2}(\ |-){0,1}[0-9]{1}(\ |-){0,1}[0-9]{3}$/;
		
	if (! (phonePattern.test(phoneVal) || mobilePattern.test(mobileVal)) ) {
		event.preventDefault();
		errorPhone.style.display = 'initial';
		errorMobile.style.display ='initial';
	}


	var ageVal = false;
	for (var i = 0;  i < age.length; i++) {
	  	if (age[i].checked) {
	  		ageVal = true;
	  	}
	}	
	if (!ageVal) {
		event.preventDefault();
		errorAge.style.display = 'initial';  	
	}
		
}