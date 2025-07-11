function memoizedIsPrime(){
    const cache={};
    return function(n){
        if(n<2)return (cache[n]=false);
        for(let i=2;i<=Math.sqrt(n);i++){
            if(n%i==0)return(cache[n]=false);
        }
        return (cache[n]=true);
    };
}
const isPrime=memoizedIsPrime()
function checkPrime(){
    const num=parseInt(document.getElementById("num").value);
    const result=document.getElementById("output");
    const status=isPrime(num);
    result.textContent=status;
}