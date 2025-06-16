const form=document.getElementById("form");
const username=document.getElementById("username");
const email=document.getElementById("email");
const password=document.getElementById("password");
const Cpassword=document.getElementById("Cpassword");
form.addEventListener("submit",function(e){
    e.preventDefault();
    if(validateInputs()){
    StoreData();}
});
const validateInputs=function(){
    const usernameValue=username.value.trim();
    const emailValue=email.value.trim();
    const passwordValue=password.value.trim();
    const CpasswordValue=Cpassword.value.trim();
    let isValid=true;
    if(usernameValue===""){
        setError(username,"Username is required");isValid=false;
    }
    else{
        setSuccess(username);
    }
    if(emailValue===""){
        setError(email,"Email is required");isValid=false;
    }else if(!isValidEmail(emailValue)){
        setError(email,"Provide a Valid Email");isValid=false;
    }
    else{
        setSuccess(email);
    }
    if(passwordValue===""){
        setError(password,"Password is required");isValid=false;
    }
    else if(passwordValue.length<8){
        setError(password,"Password must be atleast 8 characters");isValid=false;
    }
    else{
        setSuccess(password);
    }
    if(CpasswordValue===""){
        setError(Cpassword,"Please confirm your password");isValid=false;
    }
    else if(CpasswordValue!==passwordValue)
    {
        setError(Cpassword,"Password doesn't match");isValid=false;
    }
    else{
        setSuccess(Cpassword);
    }
    return isValid;
};
const setSuccess=function(element){
    const inputControl=element.parentElement;
    const errorDisplay=inputControl.querySelector('.error');
    errorDisplay.innerText="";
    inputControl.classList.add('success');
    inputControl.classList.remove('error');
};
const setError=function(element,message){
    const inputControl=element.parentElement;
    const errorDisplay=inputControl.querySelector('.error');
    errorDisplay.innerText=message;
    inputControl.classList.add('error');
    inputControl.classList.remove('success');
};
const isValidEmail=function(email){
    let regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(String(email).toLowerCase());
};
const StoreData=function(){
    localStorage.setItem("Email",email.value);
    localStorage.setItem("Password",password.value);
    localStorage.setItem("Username",username.value);
    window.location.href="login.html";
    window.alert("Signup successful");
}
