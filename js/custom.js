$(document).ready(function(){

	$('.modal').modal();
	M.textareaAutoResize($('#about-edit'));
	$('.sidenav').sidenav();

	$('select').formSelect();
	$('.dropdown-trigger').dropdown();
	$('.carousel.carousel-slider').carousel({
		fullWidth: true
	});

	var registerForm = $("#register");
	$(registerForm).submit(function(e){
		e.preventDefault();	

		var formData = $(registerForm).serialize();

		$.ajax({
			type: 'POST',
			url: "php/register-process.php",
			data: formData,
			success: function(data) {
				$("#result").html(data);
			}
		});
	})

	var loginForm = $("#login");
	$(loginForm).submit(function(e){
		e.preventDefault();	

		var formData = $(loginForm).serialize();

		$.ajax({
			type: 'POST',
			url: "php/login-process.php",
			data: formData,
			success: function(data) {
				$("#result").html(data);
			}
		});
	});
	
	
	var logoutButton = $("#logout");
	$(logoutButton).submit(function(e){

		var formData = $(logoutButton).serialize();

		$.ajax({
			type: 'POST',
			url: "php/logout-process.php",
			data: formData,
			success: function(data) {
				$("#content").html(data);
			}
		});
	});

	var followButton = $("#follow");
	$(followButton).submit(function(e){
		e.preventDefault();	
		var formData = $(followButton).serialize();

		$.ajax({
			type: 'POST',
			url: "php/follow-process.php",
			data: formData,
			success: function(data) {
				$("#content").html(data);
			}
		});
	});

	var unfollowButton = $("#unfollow");
	$(unfollowButton).submit(function(e){
		e.preventDefault();	
		var formData = $(followButton).serialize();

		$.ajax({
			type: 'POST',
			url: "php/unfollow-process.php",
			data: formData,
			success: function(data) {
				$("#content").html(data);
			}
		});
	});
});	

function showUser(str) {
	if (str == "") {
		$("#results-main").hide();
		$("#insert-main").show();
		return;
	} else {
		$("#results-main").show();
		$("#insert-main").hide();
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
	  	} else {
		  // code for IE6, IE5
		  xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	  	}
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("results").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET","php/getuser.php?q="+str,true);
		xmlhttp.send();
	}
}

/* ACCOUNT SETTING ===================================================== */
//change password click event
$('#change_password_anchor').on('click', function () {
	$(".change_current_password").removeClass("hide");
	$("#change_password_anchor").addClass("hide");
});

//Current password input and validation
$('#current_password_field_confirm').on('click', function() { 

	//Grabs current password
	var current_password = $('#current_password_field').val();

	$.ajax({
		type: "POST",
		url: "php/account_validation.php", 
		data: { //this is all saved in post array
			current_password: current_password, 
			action: 'validate_current_password'
		},
		timeout: 2000, 
		beforeSend: function(){ //loading bar
			$('#current_password_output').append('<div class="preloader-wrapper small active"><div class="spinner-layer spinner-green-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"> <div class="circle"></div></div></div></div>');
		},
		complete: function(){
		},
		success: function(data){ //I'm limited by strings for now.

			$('#current_password_output').text(data);
			var password_output = $('#current_password_output').html(data);
			var password_output = JSON.stringify(data); //turns from object to string so I can compare them below

			if(password_output.indexOf('Check!') > -1) { //I wonder why create_username === "Check!" didn't work.
				console.log("I passed!");
				// valid_username_creation = true;
				// $(".change_current_password").addClass("hide");
				$("#change_password_anchor").addClass("hide");
				$(".change_current_password").addClass("hide");
				$("#current_password_field_confirm").addClass("hide");
				$(".change_password").removeClass("hide");
			}
		},
		error: function(data){
			$('#current_password_output').text("I'm sorry, but there seems to have been an error. Please try again later");
		}
	});
});

//ON PASSWORD CHANGE CONFIRM
$("#password_change_confirm").on("click", () => {

	var new_password_field = $('#new_password_field').val();
	var confirm_new_password_field = $('#confirm_new_password_field').val();

	if(new_password_field != confirm_new_password_field) { //password must match
		$('#change_password_output').text("Passwords must match.");
		return; //so it won't continue below
	}
	if(new_password_field.length < 6) {
		$('#change_password_output').text("Password must be more than 6 characters long!");
		return;
	}
	else {
		//will run only if validation passes
		$.ajax({
			type: "POST",
			url: "php/account_validation.php", 
			data: { //this is all saved in post array
				new_password: new_password_field, //$_POST["current_password"] === "whatever current password is"
				action: 'change_password'
			},
			timeout: 2000, //i'm thinking this is if it takes longer than 2 seconds it exits?
			beforeSend: function(){ //loading bar
				$('#change_password_output').append('<div class="preloader-wrapper small active"><div class="spinner-layer spinner-green-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"> <div class="circle"></div></div></div></div>');
			},
			complete: function(){
			},
			success: function(data){ //I'm limited by strings for now.
				$('#change_password_output').text(data);
				var password_output = $('#change_password_output').html(data);
			},
			error: function(data){
				$('#change_password_output').text("I'm sorry, but there seems to have been an error. Please try again later");
			}

		});

	}

});
/* END ACCOUNT SETTING */
