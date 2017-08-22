
function base_url() {
	var pathparts = location.pathname.split('/');
	if (location.host == '192.168.0.13') {
	        var url = location.origin+'/'+pathparts[1].trim('/')+'/'; // http://localhost/myproject/
	    }else{
	        var url = location.origin; // http://stackoverflow.com
	    }
	    return url;
	}


function show5(){
	if (!document.layers&&!document.all&&!document.getElementById)
		return
	var Digital=new Date()
	var hours=Digital.getHours()
	var minutes=Digital.getMinutes()
	var seconds=Digital.getSeconds()

	var dn="PM"
	if (hours<12)
		dn="AM"
	if (hours>12)
		hours=hours-12
	if (hours==0)
		hours=12

	if (minutes<=9)
		minutes="0"+minutes
	if (seconds<=9)
		seconds="0"+seconds

	myclock=hours+":"+minutes+":"+seconds+" "+dn+""
	if (document.layers){
		document.layers.liveclock.document.write(myclock)
		document.layers.liveclock.document.close()
	}
	else if (document.all)
		liveclock.innerHTML=myclock
	else if (document.getElementById)
		document.getElementById("liveclock").innerHTML=myclock
	setTimeout("show5()",1000)
}

window.onload=show5;
// *******************FIN METODO ***********************

var numero=0;
var maxId=0;

$(document).ready(function() {


	inicializar();

	function inicializar() {
		$.ajax({
			type: "POST",
			url: base_url() + "pantalla/monitorFecha",
	            //data: dataString,
	            success: function(data) {
	            	console.log(data)
	            	if(data=="false"){
	            		truncateMonitoreo();
	            	}else{
	            		chageMonitoreo2();
	            	}
	            	
	            }
	        }) 
	}
	function chageMonitoreo2(){

		$.ajax({
			type: "POST",
			url: base_url() +  "pantalla/monitorearTotales",
	            //data: dataString,
	            success: function(data) {
	            	monitor=data;
	            }
	        }) 
	}

	function truncateMonitoreo() {
		$.ajax({
			type: "POST",
			url: base_url() + "pantalla/truncateMonitor",
	            //data: dataString,
	            success: function(data) {
	            }
	        }) 
	}
//genera tabla Espera
function getRandValue(){
	$.ajax({
		type: "POST",
		url: base_url() + "pantalla/ajax_pantalla",
	            //data: dataString,
	            success: function(data) {

	            	$('#conta').html(data);
	            	
	            }
	        }) 
}



getRandValue();	   
setInterval(change_espera, 1000);
setInterval(change, 1000);
setInterval(chageMonitoreo,1000);

function change_espera(){
	$.ajax({
		type: "POST",
		url: base_url() +  "pantalla/change_espera_derecho",
	            //data: dataString,
	            success: function(data) {
	            	if(data == maxId){
	            		
	            	}else{
	            		
	            		getRandValue();
	            		maxId=data;
	            	}
	            }
	        }) 
}
		//monitorea la cantidad de pacientes que exiten para posteriormente actualizar la tabla espera y la tabla atendiendo
		function change(){
			$.ajax({
				type: "POST",
				url: base_url() + "pantalla/change_espera",
	            //data: dataString,
	            success: function(data) {
	            	if(data == numero){
	            		
	            	}else{
	            		var bandera=0;
	            		if(data>numero){
	            			bandera=1;
	            		}
	            		
	            		getRandValue();
	            		change_paciente(bandera);
	            		numero=data;
	            	}
	            }
	        }) 
		}
//monitorea tabla paciente_espera
var monitor=0;
function chageMonitoreo(){
	$.ajax({
		type: "POST",
		url: base_url() +  "pantalla/monitorearTotales",
	            //data: dataString,
	            success: function(data) {
	            	if(data == monitor){
	            		
	            	}else{
	            		
	            		aceptMonitor();
	            		monitor=data;
	            	}
	            }
	        }) 
}

		//metodo de llamando con alert
		function aceptMonitor(){
			$.ajax({
				type: "POST",
				url: base_url() +  "pantalla/getMonitoreoUltimo",
	            //data: dataString,
	            success: function(datos) {
	            	var arrayDatos=datos.split(",");
	            	$('audio')[0].play();
	            	swal({

	            		title: 'DERECHOHABIENTE:<br><br><strong style="color:#003399"><strong>'+arrayDatos[0]+" "+arrayDatos[1],
	            		text: '<strong style="color:#ff704d"><strong>'+arrayDatos[2],
	            		imageUrl: base_url() + "plantillas/img/llamada.png",
	            		timer: 4000,
	            		showConfirmButton: false,
	            		html: true
	            	});  
	            }
	        }) 
		}

		 //funcion que llama al derechohabiente y que suena la llamada 
		 
		 function change_paciente(bandera){
		 	$.ajax({
		 		type: "POST",
		 		url: base_url() + "pantalla/consultorio_ajax",
	            //data: dataString,
	            success: function(data) {
	            	$('#datoss').html(data);
	            	if(bandera==1){

	            		$('audio')[0].play();	
	            	}
	            	
	            }

	        }); 
		 }

		 //metdo que me permite que se accualize la table de paciente pasar a consultorio
		 function change_pacienteNosuenes(bandera){
		 	$.ajax({
		 		type: "POST",
		 		url: base_url() + "pantalla/consultorio_ajax",
	            //data: dataString,
	            success: function(data) {
	            	$('#datoss').html(data);
	            	
	            	if(bandera==1){
	            		
	            	}
	            	
	            }

	        }) 
		 }
		 //setInterval metodo de javascript que permite actualizar en un rango de tiempo
		 setInterval(monitoreoPacientesConsultados,1000)
		 var monitoreoFin=0;
		 //metodo que me permite monitorear los pacientes consultados con la finalidad de quitarlos de la pantalla de 
		 //pacientes que son llamados por un doctor
		 function monitoreoPacientesConsultados(){
		 	$.ajax({
		 		type: "POST",
		 		url: base_url() +  "pantalla/monitoreoPacientesConsultados",
	            //data: dataString,
	            success: function(data) {
	            	if(data!=monitoreoFin){
	            		change_pacienteNosuenes(1);
	            		monitoreoFin=data;
	            	}
	            }
	        }) 
		 }
		});



