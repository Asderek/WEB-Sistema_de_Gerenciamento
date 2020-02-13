/**
*
*/
onload = function()
{
	//width = 1500;
	width = screen.width*0.95;
	height = screen.height*0.85;
	
	divStyle = document.getElementById('id_content').style;
	divStyle.marginTop = "0px";
	divStyle.position = "absolute";
	divStyle.overflow = "auto";
	divStyle.left = "50%";
	divStyle.top = "50%";
	divStyle.width = width+"px";
	divStyle.height = height+"px";
	divStyle.marginLeft = -width/2+"px";
	
	console.log("tchau");
	var input = document.getElementById("id_assistido");

	// Execute a function when the user releases a key on the keyboard
	input.addEventListener("keyup", function(event) {
	  // Cancel the default action, if needed
	  event.preventDefault();
	  // Number 13 is the "Enter" key on the keyboard
	  if (event.keyCode === 13) {
		// Trigger the button element with a click
		document.getElementById("id_ButtonCPF").click();
	  }
	});
	
	var acc = document.getElementsByClassName("accordion");
	var i;

	for (i = 0; i < acc.length; i++) {
	  acc[i].addEventListener("click", function() {
		this.classList.toggle("active");
		var panel = this.nextElementSibling;
		if (panel.style.maxHeight){
		  panel.style.maxHeight = null;
		} else {
		  panel.style.maxHeight = panel.scrollHeight + "px";
		} 
	  });
	}
	
	/*var acc = document.getElementsByClassName("accordion");
	var i;

	for (i = 0; i < acc.length; i++) {
		console.log("enter "+i);
	  acc[i].addEventListener("click", toggle);
	}*/
	
	var check = document.getElementById("id_checkbox");
	if (check != null)
	{
		check.addEventListener("click",checkAll);
	}
	
	var mode = "<?php echo $mode; ?>";
							
	if (mode == "listamonitoria" || mode == "listaralunosplantao" || mode == "listavisitas" || mode == "escolherplantao" )
	{
		document.getElementById("id_accordionAtividades").click();
	}
	
	if (mode == "consultaassistido" || mode == "listarassistidos" || mode == "procuraassistido")
	{
		document.getElementById("id_accordionAssistidos").click();
	}
	
}

function checkAll()
{
  var checkboxes = new Array(); 
  checkboxes = document.getElementsByTagName('input');
 
  for (var i=0; i<checkboxes.length; i++)  {
    if (checkboxes[i].type == 'checkbox')   
	{
      checkboxes[i].checked = !checkboxes[i].checked;
    }
  }
}


function toggle() {
		console.log("togleei");
	
		this.classList.toggle("active");
		var panel = this.nextElementSibling;
		if (panel.style.maxHeight){
		  panel.style.maxHeight = null;
		} else {
		  panel.style.maxHeight = panel.scrollHeight + "px";
		} 
	  }
	  

