function checkForm()
{

    var nameInput = document.getElementById("nameInput");
    var emailInput = document.getElementById("emailInput");
    var usernameInput = document.getElementById("usernameInput");
    var passwordInput = document.getElementById("passwordInput");
    var confirmationInput = document.getElementById("confirmationInput");
    
    var validRegExp = new RegExp(/^[A-Za-z0-9._]{1,32}$/);
    var emailRegExp = new RegExp(/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/);
    if(passwordInput.value === "" || confirmationInput.value === "" || nameInput.value === "" || emailInput.value === "" || usernameInput.value === "")
	{
        alert("Please provide all of the requested information");
        return false;
    }
    else if(!emailRegExp.test(emailInput.value)) // do stuff
    {
        alert("Please enter a valid email address");
        return false;
    }
    else if(passwordInput.value !== confirmationInput.value)
    {
        alert("The passwords do not match!"); // display alert window
        passwordInput.value = "";
        confirmationInput.value = "";
        return false;
    }
    else if(!validRegExp.test(usernameInput.value))
    {
        alert("Usernames must contain only alpha-numeric characters and must not exceed 32 characters in length");
        return false;
    }
	else
		return true;
  
}
