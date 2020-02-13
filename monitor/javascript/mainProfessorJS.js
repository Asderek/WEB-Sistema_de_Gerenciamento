/**
*
*/

onload = function ()
{
			console.log("onload");
            var frm = document.getElementById("id_print").contentWindow;
            frm.focus();// focus on contentWindow is needed on some ie versions
            frm.print();
			console.log("frm = "+frm);
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