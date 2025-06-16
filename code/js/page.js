document.getElementById("username").textContent = localStorage.getItem("Username");
document.getElementById("logout").onclick = function() {
    window.location.href = "login.html";
    alert("Successfuly logged Out");
};
