document.getElementById("Login-Button").onclick=function(){
    let Login_Email=document.getElementById("Login-Email").value;
    let Login_Password=document.getElementById("Login-Password").value;
    if(!Login_Email||!Login_Password){
        alert("Please fill in all fields");
    }
    else{
        let Signup_email=localStorage.getItem("Email");
        let Signup_Password=localStorage.getItem("Password");
        if(Login_Email==Signup_email&&Login_Password==Signup_Password)
        {
            window.location.href="page.html";
            alert("Login successfull!");
        }
        else{
            alert("Invalid Credentials");
            return;
        }
    }
}