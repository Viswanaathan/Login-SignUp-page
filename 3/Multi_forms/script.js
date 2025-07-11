let current = 1;
function showPage(current) {
    document.querySelectorAll(".p").forEach(c => {
        c.style.display = "none";
    });
    document.getElementById("p" + current).style.display = "block";
}
showPage(current);
function nextPage() {
    if (validate()) {
        current++;
        showPage(current);
    }
}

function prevPage() {
    current--;
    showPage(current);
}

function validate() {
    let valid = true;
    let inputs = document.getElementById("p" + current).querySelectorAll("input");

    inputs.forEach(input => {
        let id = input.id;
        switch (id) {
            case "name":
                if (input.value.trim() === "" || input.value.length < 2) {
                    failure(input, "Name must be at least 2 characters.");
                    valid = false;
                } else {
                    success(input);
                }
                break;
            case "email":
                if (input.value.trim() === "" || input.value.length < 3 || !input.value.includes("@")) {
                    failure(input, "Email must be at least 3 characters and contain '@'.");
                    valid = false;
                } else {
                    success(input);
                }
                break;
            case "street":
                if (input.value.trim() === "" || input.value.length < 3) {
                    failure(input, "Street must be at least 3 characters.");
                    valid = false;
                } else {
                    success(input);
                }
                break;
            case "city":
                if (input.value.trim() === "" || input.value.length < 3) {
                    failure(input, "City must be at least 3 characters.");
                    valid = false;
                } else {
                    success(input);
                }
                break;
            case "username":
                if (input.value.trim() === "" || input.value.length < 3) {
                    failure(input, "Username must be at least 3 characters.");
                    valid = false;
                } else {
                    success(input);
                }
                break;
            case "password":
                if (input.value.trim() === "" || input.value.length < 3) {
                    failure(input, "Password must be at least 3 characters.");
                    valid = false;
                } else {
                    success(input);
                }
                break;
        }
    });

    return valid;
}

function success(input) {
    input.style.border = "2px solid green";
    input.style.color="green";
    let d=document.getElementById(input.id + "Error");
    d.innerText = ""; 
}

function failure(input, message) {
    input.style.border = "2px solid red";
    input.style.color="red";
    let d=document.getElementById(input.id + "Error");
    d.style.color="red";
    d.innerText = message; 
}
let h = document.getElementById("holder");
if (h) {
    let buttons = h.querySelectorAll("button");
    buttons.forEach((button) => {
        button.addEventListener("click", function() {
            let bid = button.id;
            switch (bid) {
                case "1": current = 1; break;
                case "2": current = 2; break;
                case "3": current = 3; break;
            }
            showPage(current);
        });
    });
}

document.getElementById("s").onclick=function(){alert("Login successful")};