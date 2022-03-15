window.onload = function(){
	const urlParams = new URLSearchParams(window.location.search);
	const loginParam = urlParams.get('login');

	if(loginParam == "failed"){
		var loginForm = document.getElementsByTagName("form")[0];
		var loginInputs = loginForm.getElementsByTagName("input");

		for (var i = 0; i < loginInputs.length; i++) {
			loginInputs[i].classList.add("error");
			loginInputs[i].addEventListener("keyup", myfunction)
		}

		var content = document.createTextNode("data that you want to add");
		loginForm.insertAdjacentHTML('beforebegin', '<p class="login-error">Der skete en fejl. Tjek at dit brugernavn og kodeord er rigtig</p>');

		function myfunction(target){
			target.srcElement.classList.remove("error")
		}

	}


}