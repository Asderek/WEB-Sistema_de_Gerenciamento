/**
*
*/

onload = function()
{
	document.getElementById("id_Form").onsubmit = verificaCPF;
}

function verificaCPF()
{
	var CPF = document.getElementById("id_CPF").value;
	var valida = /^\d{3}\.\d{3}\.\d{3}\-\d{2}$/;
	if (valida.test(CPF))
	{
		console.log("CPF no formato Valido");
		document.getElementById('id_Form').submit();
	}
	else
	{
		console.log("CPF no formato Invalido");
		alert("CPF invalido, escreva da forma aaa.bbb.ccc-dd");
		return false;
	}
}