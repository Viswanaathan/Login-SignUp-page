function typeChar(char,delay)
{
    return new Promise(resolve=>{
        setTimeout(()=>{
            document.getElementById("output").textContent+=char;resolve();
        },delay);
    });
}
async function startTyping() {
    document.getElementById("output").textContent="";
    const textContent="Hello Hi";
    for(let i=0;i<textContent.length;i++)
    {
        await typeChar(textContent[i],100);
    }
}