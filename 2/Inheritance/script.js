class Pet{
    constructor(name,age){
        this.name=name;
        this.age=age;
    }
    describe(){
        return `${this.name} is ${this.age} years old,`;
    }
}
class Dog extends Pet{
    bark(){
        return `${this.name} says Woof!`;
    }
}
class Cat extends Pet{
    meow(){
        return `${this.name} says Meow!`;
    }
}
const dog=new Dog("Buddy",3);
const cat=new Cat("Whiskers",2);
const d=document.getElementById("dog");
const c=document.getElementById("cat");
const t=document.getElementById("text");
d.addEventListener("click",function(){
    t.textContent=dog.describe()+dog.bark();
    t.style.display="block";
})
c.addEventListener("click",function(){
    t.textContent=cat.describe()+cat.meow();
    t.display="block"
})