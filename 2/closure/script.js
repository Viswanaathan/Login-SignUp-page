function createcounter(){
    let count=0;
    return{
        increment:function(){
            count++;
        },
        decrement:function(){
            count--;
        },
        display:function(){
            document.getElementById("dis").textContent=count;
        }
    };
}
const counter=createcounter();
document.getElementById("inc").onclick=function(){
    counter.increment();
    counter.display();
}
document.getElementById("dec").onclick=function(){
    counter.decrement();
    counter.display();
}