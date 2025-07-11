function Wait(ms){
    return new Promise(resolve=>setTimeout(resolve,ms))
;}
async function greet() {
    const output=document.getElementById("output");
    output.style.color="red"
    output.textContent="Please wait...";
    await Wait(2000);
    output.style.color="green";
    output.textContent="Hello!";
    await Wait(2000);
    output.textContent="";
}