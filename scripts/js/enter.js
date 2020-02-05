document.addEventListener("DOMContentLoaded",loadDocument);
function loadDocument(){
	let inputField= document.querySelector("#quizz-upload");
	inputField.addEventListener("change", function(){
		let file = this.files[0];
		let reader = new FileReader();
		let printZone = document.querySelector("#print-zone");
		reader.onloadend = function(event){
			printZone.value = this.result;
		}
		reader.readAsText(file);
	});
};

function submit(){
	if(document.getElementById("print-zone").value){
		document.location.href="questions.html";
	}else{
		alert("/!\\ Load a file /!\\");
	}
};
