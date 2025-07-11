const input = document.getElementById("input");
window.onload = function () {
  input.focus();
};
const output = document.getElementById("output");
const buttons = document.querySelectorAll("button");
const Icon = document.getElementById("Content");
let h = "";
let b = 0;
buttons.forEach(button => {
    button.addEventListener("click", () => {
        input.focus();
        const id = button.id;
        const value = button.textContent;
        switch (id) {
            case "Clear": input.value = output.textContent = h = ""; Icon.textContent = ""; break;
            case "C": input.value = input.value.substring(0, input.value.length - 1); break;
            case "Equals": try {
                output.textContent = eval(input.value);
                h += input.value + "=" + output.textContent + "\n";
                input.value = output.textContent;
                break;
            }
                catch (e) {
                    input.value = output.textContent;
                    output.textContent = "Error"; break;
                }
            case "bracket": if (b == 0) {
                input.value += "("; b++;
            } else {
                input.value += ")"; b--;
            };
                break;
            case "P/N": if (input.value.startsWith("-")) {
                input.value = input.value.substring(1);
            }
            else {
                let temp = input.value.slice(-1);
                input.value = "-" + "(" + input.value + ")";
            } break;
            case "H":
            case "H":
                Icon.innerHTML = `
                    <button id="back" style="position:absolute; right:10px; top:10px;">
                    <box-icon name='arrow-back' color="white"></box-icon>
                    </button>
                    <pre style="padding-top: 40px; white-space: pre-wrap;">${h}</pre>
                `;
                Icon.style.display = "block";
                document.getElementById("back").onclick = function () {
                    Icon.style.display = "none";
                };
                break;

            default:
                input.value += value;
                if (input.value.length == 1 & (id == "divide" || id == "multiply" || id == "subtract" || id == "Add" || id == "percentage")) {
                    alert("Invalid Format Used");
                    input.value = ""
                }
                break;
        }
    })
})