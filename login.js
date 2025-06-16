const form=document.getElementById("form");
const email=document.getElementById("email");
const password=document.getElementById("password");
form.addEventListener("submit",(e)=>{
    e.preventDefault();
    validateInputs();
});
const validateInputs=function(){
    const emailValue=email.value.trim();
    const passwordValue=password.value.trim();
    if(emailValue==localStorage.getItem("Email")&&passwordValue==localStorage.getItem("Password"))
    {
        email.parentElement.classList.add('success');
        email.parentElement.classList.remove('error');
        password.parentElement.classList.add('success');
        password.parentElement.classList.remove('error');
        window.location.href="page.html";
        window.alert("Login successful");
}
    else{
        email.parentElement.classList.add('error');
        email.parentElement.classList.remove('success');
        password.parentElement.classList.add('error');
        password.parentElement.classList.remove('success');
        password.parentElement.querySelector('.error').innerText="Invalid Credentials";
    }
}
