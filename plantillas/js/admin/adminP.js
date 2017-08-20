

function base_url() {
	var pathparts = location.pathname.split('/');
	if (location.host == '192.168.0.13') {
	        var url = location.origin+'/'+pathparts[1].trim('/')+'/'; // http://localhost/myproject/
	    }else{
	        var url = location.origin; // http://stackoverflow.com
	    }
	    return url;
	}

$(document).on("ready", main);

	function main(){

		mostrarDatos("",1,7);

		$("input[name=busqueda]").keyup(function(){
			textobuscar = $(this).val();
			valoroption = $("#cantidad").val();
			mostrarDatos(textobuscar,1,valoroption);
		});
		$("body").on("click",".paginacion li a",function(e){
			e.preventDefault();
			valorhref = $(this).attr("href");
			valorBuscar = $("input[name=busqueda]").val();
			valoroption = $("#cantidad").val();
			mostrarDatos(valorBuscar,valorhref,valoroption);
		});

		$("#cantidad").change(function(){
			valoroption = $(this).val();
			valorBuscar = $("input[name=busqueda]").val();
			mostrarDatos(valorBuscar,1,valoroption);
		});
	}

	
	function mostrarDatos(valorBuscar,pagina,cantidad){

		$.ajax({		
			url: base_url() + "admin/mostrar",
			type: "POST",
			
			data: {buscar:valorBuscar,nropagina:pagina,cantidad:cantidad},
			dataType:"json",
			success:function(response){
				
				filas = "";
				$.each(response.clientes,function(key,item){
					filas+=
					"<tr> <td style=\'text-align: left;\'> <label  id=\'nombre"+item.id_paciente+"\'>"+item.nombre+"</label></td><td style=\'text-align: left;\'><label id=\"ape_pate"+item.id_paciente+"\">"+item.ape_pate+"</label></td><td style=\'text-align: left;\'><label id=\"ape_mate"+item.id_paciente+"\">"+item.ape_mate+"</label></td><td><label id=\"edad"+item.id_paciente+"\">"+item.edad+"</label></td> <td><label id=\"sexo"+item.id_paciente+"\">"+item.sexo+"</label></td><td> <label id=\"fecha_nacimiento"+item.id_paciente+"\">"+item.fecha_nacimiento+"</label></td><td> <label id=\"rfc"+item.id_paciente+"\">"+item.rfc+"</label></td><td> <label id=\"vigencia"+item.id_paciente+"\">"+item.vigencia+"</label></td><td><button type=\"button\" onclick=\"ajaxEliminar("+item.id_paciente+")\" class='col-gl-9 btn btn-danger text-center'>ELIMINAR</button></td></tr>"			
					;  
					
				});

				$("#tbclientes tbody").html(filas);
				linkseleccionado = Number(pagina);
			//total registros
			totalregistros = response.totalregistros;
			//cantidad de registros por pagina
			cantidadregistros = response.cantidad;

			numerolinks = Math.ceil(totalregistros/cantidadregistros);
			paginador = "<ul class='pagination'>";
			if(linkseleccionado>1)
			{
				paginador+="<li><a href='1'>&laquo;</a></li>";
				paginador+="<li><a href='"+(linkseleccionado-1)+"' '>&lsaquo;</a></li>";

			}
			else
			{
				paginador+="<li class='disabled'><a href='#'>&laquo;</a></li>";
				paginador+="<li class='disabled'><a href='#'>&lsaquo;</a></li>";
			}
			//muestro de los enlaces 
			//cantidad de link hacia atras y adelante
			cant = 2;
 			//inicio de donde se va a mostrar los links
 			pagInicio = (linkseleccionado > cant) ? (linkseleccionado - cant) : 1;
			//condicion en la cual establecemos el fin de los links
			if (numerolinks > cant)
			{
				//conocer los links que hay entre el seleccionado y el final
				pagRestantes = numerolinks - linkseleccionado;
				//defino el fin de los links
				pagFin = (pagRestantes > cant) ? (linkseleccionado + cant) :numerolinks;
			}
			else 
			{
				pagFin = numerolinks;
			}

			for (var i = pagInicio; i <= pagFin; i++) {
				if (i == linkseleccionado)
					paginador +="<li class='active'><a href='javascript:void(0)'>"+i+"</a></li>";
				else
					paginador +="<li><a href='"+i+"'>"+i+"</a></li>";
			}
			//condicion para mostrar el boton sigueinte y ultimo
			if(linkseleccionado<numerolinks)
			{
				paginador+="<li><a href='"+(linkseleccionado+1)+"' >&rsaquo;</a></li>";
				paginador+="<li><a href='"+numerolinks+"'>&raquo;</a></li>";

			}
			else
			{
				paginador+="<li class='disabled'><a href='#'>&rsaquo;</a></li>";
				paginador+="<li class='disabled'><a href='#'>&raquo;</a></li>";
			}
			
			paginador +="</ul>";
			$(".paginacion").html(paginador);

		}
	});

	}


	function ajaxEliminar(id)
	{

		var nombre=document.getElementById("nombre"+id).innerHTML;
		var ape_pate=document.getElementById("ape_pate"+id).innerHTML;
		var ape_mate=document.getElementById("ape_mate"+id).innerHTML;
		var rfc=document.getElementById("rfc"+id).innerHTML;
		var sexo=document.getElementById("sexo"+id).innerHTML;
		var vigencia=document.getElementById("vigencia"+id).innerHTML;
		var edad=document.getElementById("edad"+id).innerHTML;
		var fecha=document.getElementById("fecha_nacimiento"+id).innerHTML;
		
		swal({
			title: "ESTA SEGURO DE ELIMINAR DERECHOHABIENTE",
         // text: "You will not be able to recover this imaginary file!",
         type: "warning",
         showCancelButton: true,
         confirmButtonColor: "#DD6B55",
         confirmButtonText: "SI, ELIMINAR AHORA!",
         closeOnConfirm: false
     }, function (isConfirm) {
     	if (!isConfirm) return;
     	$.ajax({
     		url: base_url() + "admin/eliminarDerechohabiente",
     		type: "POST",
     		data: {
     			id: id
     		},
     		dataType: "html",
     		success: function () {
     			swal("HECHO!", "DERECHOHABIENTE ELEMINADO!", "success");
     			setTimeout(function() {
     				window.location.href = base_url()+"admin/eliminar";
     			}, 2000);
     		},
     		error: function (xhr, ajaxOptions, thrownError) {
     			swal("Error deleting!", "Please try again", "error");
     		}
     	});
     });

	}
