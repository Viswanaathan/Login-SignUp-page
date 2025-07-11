const students = [
  { name: "Asha", score: 92 },
  { name: "Rahul", score: 67 },
  { name: "Meena", score: 85 },
  { name: "Kishore", score: 45 },
  { name: "Lina", score: 76 }
];
const pass=students.filter(s=>s.score>=60);
const sorted=pass.sort((a,b)=>b.score-a.score);
const display=sorted.map(s=>`${s.name}-${s.score} points`);
const total=pass.reduce((x,y)=>x+y.score,0);
const average =total/pass.length;
a1=document.getElementById("a1");
a2=document.getElementById("a2");
a1.textContent=display;
a2.textContent=average