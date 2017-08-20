
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
      mostrarDatoss("",1,7);

      $("input[name=busqueda]").keyup(function(){
        textobuscar = $(this).val();
        valoroption = $("#cantidad").val();
        mostrarDatoss(textobuscar,1,valoroption);
      });

      $("body").on("click",".paginacionn li a",function(e){
        e.preventDefault();
        valorhref = $(this).attr("href");
        valorBuscar = $("input[name=busqueda]").val();
        valoroption = $("#cantidad").val();
        mostrarDatoss(valorBuscar,valorhref,valoroption);
      });

      $("#cantidad").change(function(){
        valoroption = $(this).val();
        valorBuscar = $("input[name=busqueda]").val();
        mostrarDatoss(valorBuscar,1,valoroption);
      });
    }


    function mostrarDatoss(valorBuscar,pagina,cantidad){

      $.ajax({    
        url: base_url() + "enfermero/EditarDerechohabiente",
        type: "POST",
        
        data: {buscar:valorBuscar,nropagina:pagina,cantidad:cantidad},
        dataType:"json",
        success:function(response){
          

          filas = "";
          $.each(response.clientes,function(key,item){
            filas+=
            "<tr> <td style=\"text-align: left \"> <label id=\'nombre"+item.id_paciente+"\'>"+item.nombre+"</label></td><td style=\"text-align: left \"><label id=\"ape_pate"+item.id_paciente+"\">"+item.ape_pate+"</label></td><td style=\"text-align: left \"><label id=\"ape_mate"+item.id_paciente+"\">"+item.ape_mate+"</label></td><td><label id=\"edad"+item.id_paciente+"\">"+item.edad+"</label></td> <td><label id=\"sexo"+item.id_paciente+"\">"+item.sexo+"</label></td><td> <label id=\"fecha_nacimiento"+item.id_paciente+"\">"+item.fecha_nacimiento+"</label></td><td> <label id=\"rfc"+item.id_paciente+"\">"+item.rfc+"</label></td><td> <label id=\"vigencia"+item.id_paciente+"\">"+item.vigencia+"</label></td><td><button type=\"button\"  data-toggle=\"modal\" data-target=\"#editarPacienteM\" onclick=\"ajaxEditarDerechohabiente("+item.id_paciente+")\" class='col-gl-9 btn btn-warning text-center'> EDITAR</button></td></tr>"      
            ;  
            
          });

          $("#tbPacientes tbody").html(filas);
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
      $(".paginacionn").html(paginador);

    }
  });

    }


    function validarFecha() 
    {

      var fecha   = document.getElementById('nacimiento').value;   
      if(fecha === null){
       sweetAlert("Oops...","VERIFIQUE LA FECHA DE NACIEMIENTO","error");  
       return false; 
     }           
     if (fecha != undefined && fecha.value != "" ){
       fecha=fecha.replace(/-/g,'/');
       var expreg = /^([0-9]{4})\/([0-9]{2})\/([0-9]{2})$/;
       if (!expreg.test(fecha)){
         sweetAlert("Oops...","VERIFIQUE LA FECHA DE NACIEMIENTO","error");  
         return false;
       }
       var anio =  parseInt(fecha.substring(0,4));   
       var dia  =  fecha.substring(8,10); 
       var mes  =  fecha.substring(5,7);
       
       switch(mes){
        case "01":
        case "03":
        case "05":
        case "07":
        case "08":
        case "10":
        case "12":
        numDias=31;
        break;
        case "04": 
        case "06": 
        case "09": 
        case "11":
        numDias=30;
        break;
        case "02":
        if (comprobarSiBisisesto(anio)){ numDias=29 }else{ numDias=28};
        break;
        default:
        sweetAlert("Oops...","VERIFIQUE LA FECHA DE NACIEMIENTO","error");  
        return false;
      }
      
      if (dia>numDias || dia==0){
        return false;
      }
      
        // return true;
      }
    }

    function validaRFC()
    {

     var rfcV   = document.getElementById('rfcValida').value;
     
     var strCorrecta;
     strCorrecta = rfcV; 
     if (rfcV.length == 10){
      var valid = '^(([A-Z]){4})([0-9]{6})';
    }else{
      var valid = '^(([A-Z]){4})([0-9]{6})';
    }
    var validRfc=new RegExp(valid);
    var matchArray = strCorrecta.match(validRfc);
    if (matchArray==null) {

     sweetAlert("Oops...","RFC NO CUMPLE CON EL FORMATO", "error");  
     document.getElementById('rfcValida').focus(); 
     return false;
   }
   
   
 }
 
 function comprobarSiBisisesto(anio){
  if ( ( anio % 100 != 0) && ((anio % 4 == 0) || (anio % 400 == 0))) {
    return true;
  }
  else {
    return false;
  }
} 


function insert_pacienteR(){

 var nombre   = document.getElementById('nombreValidar').value;      
 if(nombre === ""){
  sweetAlert("Oops...","NOMBRE ES UN DATO OBLIGATORIO","error");   
  
  return false;               
}else if(nombre.length>30){
  sweetAlert("Oops...","NOMBRE ES MUY LARGO","error");   
}      
var apellido = document.getElementById('apellidoValidar').value;
if(apellido === ""){               
 sweetAlert("Oops...","APELLIDO PATERNO ES UN DATO OBLIGATORIO","error"); 
 return false;
} else if(apellido.length>30){                  
  sweetAlert("Oops...","APELLIDO PATERNO MUY LARGOS","error"); 
  return false;
}         
var apellidoM = document.getElementById('apellidoValidarM').value;
if(apellidoM === ""){               
 sweetAlert("Oops...","APELLIDO PATERNO ES UN DATO OBLIGATORIO","error"); 
 return false;
} else if(apellidoM.length>30){                  
  sweetAlert("Oops...","APELLIDO PATERNO MUY LARGOS","error"); 
  return false;
}   
var opciones = document.getElementById("sexoValida").selectedIndex;
if( opciones == null) {
  sweetAlert("Oops...","SELECCIONES SEXO DEL DERECHOHABIENTE", "error");                
  return false;
}else if(opciones === 0 ){
  sweetAlert("Oops...","SELECCIONES SEXO DEL DERECHOHABIENTE", "error");   
  return false;
}  
var fecha   = document.getElementById('nacimiento').value;   
if(fecha === ""){
 sweetAlert("Oops...","INGRESE LA FECHA DE NACIEMIENTO","error");  
 return false; 
}   
var rfc   = document.getElementById('rfcValida').value;
if(rfc === ""){
  sweetAlert("Oops...","RFC ES UN DATO OBLIGATORIO", "error");               
  return false;
}
var opciones = document.getElementById("vigenciaValida").selectedIndex;
if( opciones == null) {
  sweetAlert("Oops...","SELECCIONES VIGENCIA DEL DERECHOHABIENTE", "error");                
  return false;
} else if(opciones === 0 ){
  sweetAlert("Oops...","SELECCIONES VIGENCIA DEL DERECHOHABIENTE", "error");                   
  return false;
} 

  $.ajax({
   type: "POST",
   url: base_url()+"enfermero/new_paciente",
   data: $("#form_agregaDERECHO").serialize(),
   success: function(respuesta) 
   {
    if(respuesta)
     {
     
      window.location.href = base_url()+"enfermero/consultasr";    
      }
    }
  }); 
}     


function ajaxEditarDerechohabiente(id_paciente) 
{
 var nombre=document.getElementById("nombre"+id_paciente).innerHTML;

 var ape_pate=document.getElementById("ape_pate"+id_paciente).innerHTML;
 var ape_mate=document.getElementById("ape_mate"+id_paciente).innerHTML;
 var rfc=document.getElementById("rfc"+id_paciente).innerHTML;
 var sexo=document.getElementById("sexo"+id_paciente).innerHTML;
 var vigencia=document.getElementById("vigencia"+id_paciente).innerHTML;
 var edad=document.getElementById("edad"+id_paciente).innerHTML;

 var fecha=document.getElementById("fecha_nacimiento"+id_paciente).innerHTML;

 document.getElementById("idEditar").innerHTML=id_paciente+"";
 document.getElementById("idEditar").value=id_paciente;
 document.getElementById("nombreEditar").value=nombre;
 document.getElementById("apellidoEditar1").value=ape_pate;
 document.getElementById("apellidoEditar2").value=ape_mate;
 document.getElementById("fecha_nacimientoC").value=fecha;     
 document.getElementById("sexoEditar").value=sexo;     
 document.getElementById("edadEditar").value=edad;
 document.getElementById("rfcEditar").value=rfc;
 document.getElementById("vigenciaEditaRr").value=vigencia;



}


function validaRFC_UPDATE()
{

 var rfcV   = document.getElementById('rfcEditar').value;
 
 var strCorrecta;
 strCorrecta = rfcV; 
 if (rfcV.length == 10){
  var valid = '^(([A-Z]){4})([0-9]{6})';
}else{
  var valid = '^(([A-Z]){4})([0-9]{6})';
}
var validRfc=new RegExp(valid);
var matchArray = strCorrecta.match(validRfc);
if (matchArray==null) {

 sweetAlert("Oops...","RFC NO CUMPLE CON EL FORMATO", "error");  
 document.getElementById('rfcEditar').focus(); 
 return false;
}


}


function validarFecha_Update() 
{

  var fecha   = document.getElementById('fecha_nacimientoC').value;   
  if(fecha === null){
   sweetAlert("Oops...","VERIFIQUE LA FECHA DE NACIEMIENTO","error");  
   return false; 
 }           
 if (fecha != undefined && fecha.value != "" ){
   fecha=fecha.replace(/-/g,'/');
   var expreg = /^([0-9]{4})\/([0-9]{2})\/([0-9]{2})$/;
   if (!expreg.test(fecha)){
     sweetAlert("Oops...","VERIFIQUE LA FECHA DE NACIEMIENTO","error");  
     return false;
   }
   var anio =  parseInt(fecha.substring(0,4));   
   var dia  =  fecha.substring(8,10); 
   var mes  =  fecha.substring(5,7);
   
   switch(mes){
    case "01":
    case "03":
    case "05":
    case "07":
    case "08":
    case "10":
    case "12":
    numDias=31;
    break;
    case "04": 
    case "06": 
    case "09": 
    case "11":
    numDias=30;
    break;
    case "02":
    if (comprobarSiBisisesto(anio)){ numDias=29 }else{ numDias=28};
    break;
    default:
    sweetAlert("Oops...","VERIFIQUE LA FECHA DE NACIEMIENTO","error");  
    return false;
  }
  
  if (dia>numDias || dia==0){
    return false;
  }
  
        // return true;
      }
    }



    function  update_derechohabiente()
    {
      var nombre   = document.getElementById('nombreEditar').value;      
      if(nombre === ""){
        sweetAlert("Oops...","NOMBRE ES UN DATO OBLIGATORIO","error");   
        
        return false;               
      }else if(nombre.length>30){
        sweetAlert("Oops...","NOMBRE ES MUY LARGO","error");   
      }      
      var apellido = document.getElementById('apellidoEditar1').value;
      if(apellido === ""){               
       sweetAlert("Oops...","APELLIDO PATERNO ES UN DATO OBLIGATORIO","error"); 
       return false;
     } else if(apellido.length>30){                  
      sweetAlert("Oops...","APELLIDO PATERNO MUY LARGOS","error"); 
      return false;
    }         
    var apellidoM = document.getElementById('apellidoEditar2').value;
    if(apellidoM === ""){               
     sweetAlert("Oops...","APELLIDO PATERNO ES UN DATO OBLIGATORIO","error"); 
     return false;
   } else if(apellidoM.length>30){                  
    sweetAlert("Oops...","APELLIDO PATERNO MUY LARGOS","error"); 
    return false;
  }   
  
  var fecha   = document.getElementById('fecha_nacimientoC').value;   
  if(fecha === ""){
   sweetAlert("Oops...","INGRESE LA FECHA DE NACIEMIENTO","error");  
   return false; 
 }   
 var rfc   = document.getElementById('rfcEditar').value;
 if(rfc === ""){
  sweetAlert("Oops...","RFC ES UN DATO OBLIGATORIO", "error");               
  return false;
}
var opciones = document.getElementById("vigenciaEditaRr").selectedIndex;
if( opciones == null) {
  sweetAlert("Oops...","SELECCIONES VIGENCIA DEL DERECHOHABIENTE", "error");                
  return false;
} else if(opciones === 0 ){
  sweetAlert("Oops...","SELECCIONES VIGENCIA DEL DERECHOHABIENTE", "error");                   
  return false;
} 

$.ajax({
 type: "POST",
 url: base_url()+"enfermero/update_paciente",
 data: $("#update_derechohabienteDatos").serialize(),
 success: function(respuesta) 
 {
  if(respuesta)
  {
    swal("HECHO!", "DERECHOHABIENTE SE ACTUALIZO CORRECTAMENTE!", "success");
    setTimeout(function(){
      window.location.href = base_url()+"enfermero/registro";  
      
    },
    2000);    
  }            

}
});

}

