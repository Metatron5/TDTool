function clickBtnLogin(){
    checkInputs();
}

function checkInputs(){
    var username = document.getElementById('login-input-username');
    var password = document.getElementById('login-input-password');

    if(username.value == ""){
        username.style.border = "1px solid #9c0000";
        username.style.backgroundColor = "#ff7a7a";
        username.style.color= "red";
    }

    if(password.value == ""){
        password.style.border = "1px solid #9c0000";
        password.style.backgroundColor = "#ff7a7a";
        password.style.color= "red";
    }

    if(password.value == "" || username.value == ""){
        alert("Bitte die markierten Felder korrekt ausfüllen.");
        return(null);
    }else{
        
    }
}