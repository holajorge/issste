
function base_url() {
  var pathparts = location.pathname.split('/');
  if (location.host == '192.168.0.13') {
          var url = location.origin+'/'+pathparts[1].trim('/')+'/'; // http://localhost/myproject/
      }else{
          var url = location.origin; // http://stackoverflow.com
      }
      return url;
  }


function insert_doctor(){
 var nombre   = document.getElementById('descripcion').value;      
 if(nombre === ""){
   sweetAlert("Oops...","DESCRIPCION ES UN DATO OBLIGATORIO","error");              
   return false;               
 }else if(nombre.length>30){
  sweetAlert("Oops...","DESCRIPCION ES MUY LARGO","error");   
}      

$.ajax({
 type: "POST",
 url: base_url()+"doctor/alta_paciente",
 data: $("#form_agregaDD").serialize(), 
 success: function(respuesta) 
 {
   if(respuesta)
   {
    swal("GRACIAS!", "DERECHOHABIENTE CONSULTADO!", "success");
    setTimeout(function() 
    {
      window.location.href = base_url()+"doctor";
    }, 2000);     
  }
}
});

}

function confirmPantalla_doctor()
{
  swal({
    title: "EL DERECHOHABIENTE VOLVERA A LA LISTA DE ESPERA",
              // text: "You will not be able to recover this imaginary file!",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "SI, PROGRAMAR AHORA!",
              closeOnConfirm: false
            },function (isConfirm) {
              if (!isConfirm) return;
              $.ajax({
               type: "POST",
               url:  base_url()+"doctor/Cambiar_estadoVolverPantalla",
             data: $("#form_agregaDD").serialize(), // si la respuesta es si 

             success: function(respuesta) 
             {
               if(respuesta)
               {
                 swal("HECHO!", "DERECHOHABIENTE EN ESPERA!", "success");
                 setTimeout(function() 
                 {
                  window.location.href = base_url()+"doctor";
                }, 2000);     
               }
             }
        }); //squi termino yo 
            })
}

function noPresentoPaciente()
{
  swal({
    title: "EL DERECHOHABIENTE SE ELIMINAR",
              // text: "You will not be able to recover this imaginary file!",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "SI, ELIMINAR AHORA!",
              closeOnConfirm: false
            },function (isConfirm) {
              if (!isConfirm) return;
              $.ajax({
               type: "POST",
               url:  base_url()+"doctor/eliminar",
             data: $("#form_agregaDD").serialize(), // si la respuesta es si 

             success: function(respuesta) 
             {
               if(respuesta)
               {
                 swal("HECHO!", "DERECHOHABIENTE ELIMINADO!", "success");
                 setTimeout(function() 
                 {
                  window.location.href = base_url()+"doctor";
                }, 2000);     
               }
             }
        }); //squi termino yo 
            })
}


function volverallamarD()
{
  $.ajax({
   type: "POST",
   url:  base_url()+"doctor/volverAllamar",
             data: $("#form_agregaDD").serialize(), // si la respuesta es si 

             success: function(respuesta) 
             {
               swal({
                title: "LLAMANDO AL PACIENTE",
                text: document.getElementsByName("nombre")[0].value,
                timer: 2000,
                showConfirmButton: false
              });  
             }
        }); //squi termino yo 
      // });
    }