function *qr(){
    const qs=[    "Believe in yourself.",
    "Push through the hard days.",
    "Every step counts.",
    "You’ve got this!",
    "Keep showing up."];
    let index=0;
    while(true){
        yield qs[index];
        index=(index+1)%qs.length;
    }
}
const gene=qr();
function show(){
    const d=document.getElementById("q");
    d.textContent=gene.next().value;
}