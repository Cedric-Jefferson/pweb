document.addEventListener("DOMContentLoaded",addEvent);
function addEvent(){
	document.querySelector("#insert").addEventListener("click",function(){
		document.location.href="textEnter.html";
	});
	document.querySelector("#session").addEventListener("click",function(){
		document.location.href="showSession.php";
	});
	document.querySelector("#user").addEventListener("click",function(){
		document.location.href="show.php";
	});
	document.querySelector("#create").addEventListener("click",function(){
		document.location.href="create.html";
	});
	document.querySelector("#add").addEventListener("click",function(){
		document.location.href="add.html";
	});
	document.querySelector("#adduser").addEventListener("click",function(){
		document.location.href="adduser.html";
	});
	document.querySelector("#showuser").addEventListener("click",function(){
		document.location.href="showuser.html";
	});
}