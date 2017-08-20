<HTML>
	<HEAD>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>


		<script type="text/javascript">
			
				$('#mundo').click(function(){

    alert("NOMBRE");

});



		</script>
		<!-- <script>
			function makeAjaxCall(){
				$.ajax({
					type: "post",
					url: "http://localhost/issste/admin/new_consultorio",
					cache: false,    
					data: $('#userForm').serialize(),
					success: function(json){      
						try{  
							var obj = jQuery.parseJSON(json);
							alert( obj['STATUS']);

						}catch(e) {  
							alert('exitoso');
						}  
					},
					error: function(){      
						alert('exitoso2');
					}
				});
			}

				  {
                        var obj = JSON.parse(respuesta);
                        console.log(obj);
                        if (obj.R == true) {
                            swal(
                                    {
                                        title: 'Datos Guardados',
                                        type: 'success',
                                        confirmButtonText: 'aceptar',
                                        animation: false
                                    }).then(function()
                                    {

                                    });
                                }
                            }

		</script> -->
	</HEAD>
	<BODY>
		<form name="userForm" id="userForm" action="">
			<table border="1">
				<tr>
					<td valign="top" align="left">  
						Username:- <input type="text" name="nombre" id="nombre" value="">
					</td>
				</tr>
				
				<tr><tr>
					<td valign="top" align="left">  
						email :- <input type="email" name="ubicacion" id="ubicacion" value="">
					</td>
				</tr>
					<td>
						<input type="button" id="mundo" name="mundo" value="Submit"/>
					</td>
				</tr>
			</table>
			<button id="hola" name="hola">hola</button>
		</form>
	</BODY>
</HTML>