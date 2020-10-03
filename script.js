enviar = document.querySelector("#formulario-arquivo");


enviar.addEventListener("submit", function(event)
{
	event.preventDefault();
	data = new FormData(this);	
	

	var xhr = new XMLHttpRequest();
	xhr.open(this.method, this.action, true);

	xhr.addEventListener("load", function(){
		
		if(xhr.status==200)
		{
		    let response = JSON.parse(this.responseText);       

			if(response == "sucesso")
			{
				alert("Dados armazenados com sucesso");
				enviar.reset();
			}
			else
			{
				alert("Os dados não foram armazenados");
				enviar.reset();
			}
			
		}
		else
		{			
			alert("Falha ao enviar arquivo!");
		}		

	});

	xhr.send(data);
});



