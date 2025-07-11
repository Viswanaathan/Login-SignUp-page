function check(ans,callback){
    const correct="true";
    if(ans===correct)
    {
        callback(true);
    }
    else{
        callback(false);
    }
}
function submit(ans){
    check(ans,function(decider){
        const result=document.getElementById("result");
        if(decider){
            result.style.color="green";
            result.textContent="Correct!";
        }else{
            result.style.color="red";
            result.textContent="Wrong!";
        }
    });
}