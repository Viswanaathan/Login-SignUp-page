document.getElementById("Signup-Button").onclick = function(event) {
    let Signup_Email = document.getElementById("Signup-Email").value;
    let Signup_Username = document.getElementById("Signup-Username").value;
    let Signup_Password = document.getElementById("Signup-Password").value;
    let Confirm_Signup_Password = document.getElementById("Confirm-Signup-Password").value;

    if( !Signup_Email ||  Signup_Email ==''){
        erros.inner ="EMail "
    }

    // if (!Signup_Email || !Signup_Username || !Signup_Password || !Confirm_Signup_Password) {
    //     alert("Please fill in all fields.");
    //     return;
    // }

    if (Signup_Password === Confirm_Signup_Password) {
        localStorage.setItem("Username", Signup_Username);
        localStorage.setItem("Email", Signup_Email);
        localStorage.setItem("Password", Signup_Password);
        window.location.href = "login.html";
        
        alert("Signup successful!");
    } else {
        alert("Passwords do not match.");
    }
};
