function checkForm()
{

  
    var emailInput = document.getElementById("emailInput");
    var oldPasswordInput = document.getElementById("oldPasswordInput");
    var passwordInput = document.getElementById("passwordInput");
    var confirmationInput = document.getElementById("confirmationInput");
    

    var emailRegExp = new RegExp(/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/);
	
	if (oldPasswordInput.value === "") {
		alert("Password required");
		return false;
	}
	
    if((passwordInput.value === "" || confirmationInput.value === "") && emailInput.value === "") 
	{
		alert("Please provide required input");
		return false;
    }
	
	else {
    
		if(passwordInput.value !== "" && confirmationInput.value !== "") {
	
			if(passwordInput.value !== confirmationInput.value)
			{
				alert("The passwords do not match!"); // display alert window
				passwordInput.value = "";
				confirmationInput.value = "";
				return false;
			}
		
		}

		if (emailInput.value !== "") {		
			if(!emailRegExp.test(emailInput.value)) {
			alert("Please enter a valid email address");
			return false;
			} 
		}
			
		
	}
	
	return true;
  
}
