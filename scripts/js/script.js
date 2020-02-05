//questions script
let timer;
let current;
let tmp;
let score;
let questions;
let total;
const timeToAnswer=16;

//questions functions
function nbquestions(){
	return questions.length;
};

function points(question){
	return questions[0];
};

//timer
function timerStart() {
	tmp=timeToAnswer;
	current=0;
	score=0;
	timer = setInterval(tick, 1000);
};

function tick(){
	refTime(-1);
	if(tmp <= 0)
		fin();
};

function refTime(t){
	tmp += t;
	document.querySelector('#timer').innerHTML="TIME:"+tmp;
};

function fin(){
	document.querySelectorAll("input[type=checkbox]:checked").forEach(function(element){
		element.checked=false;
	});
	sumit();
};

//show and hide functions
document.addEventListener("DOMContentLoaded",loadQuestionOne);
function loadQuestionOne(){
	loadDocument();
	total=0;
	questions.forEach(function(element){
		total+=Number(element.score);
	});
	showQuestion(0);
	timerStart();
    document.addEventListener("submit", processForm);
};


//Récupération du fichier
function lireFichierTexte(fichier){
 //On lance la requête pour récupérer le fichier
 var fichierBrut = new XMLHttpRequest();
 fichierBrut.open("GET", fichier, false);
 fichierBrut.overrideMimeType("text/plain");
 fichierBrut.send(null);
 let ret=fichierBrut.responseText;
 fichierBrut.abort()
 return ret;
}

function loadDocument(){ //a recoder let file contient fichier
	let dataQuest;
	// let inputField= document.querySelector("#quizz-upload");
	// inputField.addEventListener("change", function(){
		file = lireFichierTexte(file);
		file.replace("'","");
		// let reader = new FileReader();
		// let printZone = document.querySelector("#print-zone");
		// reader.onloadend = function(event){
			dataQuest = [];
			let lines = file.split("\n");
			let n = lines.length;
			let i = 0;
			do{
				let data = {
					label: lines[i],
					score: lines[i+1],
					answer: [],
					nb_purposes: lines[i+3],
					purposes: []
				}
				let line_argument = lines[i+2].split(",");
				for(let j = 0; j < line_argument.length; j++)
					data.answer[j] = line_argument[j];
				for(let k = 0; k < data.nb_purposes; k++)
					data.purposes[k] = lines[i+4+k];
				dataQuest.push(data);  
				i = i+4+(Number(data.nb_purposes));
			}while(i<n);
			// sessionStorage.setItem('Questions', JSON.stringify(dataQuest));
			// printZone.value = this.result;
			questions = dataQuest;
		// }
		// reader.readAsText(file);
	// });
};

function showQuestion(number){
	let quest=document.querySelector("#quest");
	quest.innerHTML=questions[number].label+"<br>";
	for(let i=0;i<questions[number].nb_purposes;i++){
		quest.innerHTML+="<br><label><input type='checkbox' name='q"+number+"' id='resp"+number+i+"' />"+questions[number].purposes[i]+"</label>";
	}
	quest.innerHTML+="<br><br>";
};

function finishQuestion(){
	let result=document.querySelector("#result");
	let quest=document.querySelector("#quest");
	let point=0;
	let ok=true;
	let res="resp"+current;
	let check =quest.querySelectorAll("input[type=checkbox]:checked");
	let needed="<div class='italic'>Required answer:</div>";
	let answered="<div class='italic'>You answered:</div>";
	if(check.length!=questions[current].answer.length){
		ok=false;
	}
	check.forEach(function(element) {
		if(ok){
			let i=0;
			let fin=false;
			let correct;
			while(i<questions[current].answer.length && !fin){
				if(element.id==res+Number(questions[current].answer[i]-1)){
					fin=true;
					correct=true;
				}else{
					correct=false;
				}
				i++;
			}
			if(!correct){
				ok=false;
			}
		}
		answered+="&#9658"+element.parentElement.innerHTML+"<br>";
		
	});
	if(ok){
		point=Number(questions[current].score);
		score+=point;
	}
	for(let i=0;i<questions[current].answer.length;i++){
		needed+="&#9658"+document.querySelector("#resp"+current+Number(questions[current].answer[i]-1)).parentElement.innerHTML+"<br>";
	}
	result.innerHTML+="___________________________________________________<br>"
	result.innerHTML+="<br><div class='underline'>Question "+(current+1)+":</div>"+questions[current].label+"<br><br><div class='bold'>Points:</div>"+point+"/"+questions[current].score+"<br><br>"+answered+"<br>"+needed+"<br><div class='bold'>Time:</div>"+(timeToAnswer-tmp)+"s<br><br><div class='bold'>Coeff:</div>"+(Number(questions[current].score)/total*100)+"%<br>";
};

//submit function
function processForm(e) {
    if (e.preventDefault) e.preventDefault();
	sumit();
}

function sumit(){
	finishQuestion();
	if(current!=nbquestions()-1){
		showQuestion(current+1);
		tmp=timeToAnswer;
	}
	if(current==nbquestions()-1){
		document.querySelector("#container").innerHTML="";
		document.querySelector("#container").classList.remove("active");
		clearInterval(timer);
		document.getElementById("result").classList.add("active");
		document.querySelector('#timer').classList.add("hide");
		document.querySelector('#score').innerHTML="<div class='bold'>&#9700; Your score: "+score+"/"+total+" &#9698;</div>";
		document.querySelector("body").classList.add("show");
		document.querySelectorAll("input[type='checkbox']").forEach(function(element){
			element.classList.add("hide");
		});
		document.getElementById("result").innerHTML+="___________________________________________________<br>";
		passcrore();
	}
	current++;
    return false;
}
//pass score to php
function passcrore(){
	let data=score+"/"+total;
	let xhr = new XMLHttpRequest();
	xhr.open("POST", "score.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");                  
	xhr.send("score=" + data);
}
