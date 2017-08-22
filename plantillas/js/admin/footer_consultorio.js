  
$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').focus()
});

$('#myModalD').on('shown.bs.modal', function () {
  $('#myInput').focus()
})


$('#editarDoctorModal').on('shown.bs.modal', function () {
  $('#myInput').focus()
});

function base_url() {
  var pathparts = location.pathname.split('/');
  if (location.host == '192.168.0.13') {
          var url = location.origin+'/'+pathparts[1].trim('/')+'/'; // http://localhost/myproject/
      }else{
          var url = location.origin; // http://stackoverflow.com
      }
      return url;
  }



function resetear()
  {
   $('#actualiza_consultorio')[0].reset();

  }
function cancelarRegistro()
  {
    $('#form_agregaC')[0].reset();
  }

 function verficUsernameC(){
    
    $.ajax({
     type: "POST",
     url: base_url()+"admin/buscaUsernameC",
           data: $("#actualiza_consultorio").serialize(), // serializes the form's elements.,
           success: function(respuesta) 
           {
             if(respuesta==1)
             {
              swal("Error!", "CONSULTORIO EXISTENTE, PRUEBE CON OTRO", "error");
            }
          }
        }) 
  }

  function verficUsernameC_Registro(){
    
    $.ajax({
     type: "POST",
     url: base_url()+"admin/buscaUsernameC",
           data: $("#form_agregaC").serialize(), // serializes the form's elements.,
           success: function(respuesta) 
           {
             if(respuesta==1)
             {
              swal("Error!", "CONSULTORIO EXISTENTE, PRUEBE CON OTRO", "error");
            }
          }
        }) 
  }

  function insert_consultorio(){
    var nombre   = document.getElementById('nombreValidar').value;      

    if(nombre === ""){
      sweetAlert('error',"NOMBRE CONSULTORIO OBLIGATORIO","error");              
      nombre.focus();
    }   

    var ubicacion = document.getElementById('ubicacionValidar').value;
    if(ubicacion === ""){               
     sweetAlert("UBICACION OBLIGATORIO","INTENTE DE NUEVO","error"); 
     return false;
   } else if(ubicacion.length>50){                  
    sweetAlert("APELLIDOS MUY LARGOS","INSTENTE DE NUEVO","error"); 
    return false;
  }   

  
  $.ajax({
   type: "POST",
   url:  base_url()+"admin/new_consultorio",
               data: $("#form_agregaC").serialize(), // serializes the form's elements.,
               success: function(respuesta) 
               {
                 if(respuesta)
                 {
                  swal("HECHO!", "CONSULTORIO AGREGADO!", "success");
                  setTimeout(function() 
                  {
                    window.location.href =  base_url()+"admin/Consultorio";
                  }, 2000);     
                }
              }
          }) //fin ajax2    
}


 //donde ira
 function update_consul()
 {
  var nombre   = document.getElementById('nombreEditar').value;      
  if(nombre === ""){
    sweetAlert("NOMBRE CONSULTORIO OBLIGATORIO","INSTENTE DE NUEVO","error");              
    return false;    

  }else if(nombre.length>30){
   sweetAlert("nombre muy largo","INSTENTE DE NUEVO","error"); 
 }    

 var ubicacion = document.getElementById('ubicacionEditar').value;
 if(ubicacion === ""){               
   sweetAlert("UBICACION OBLIGATORIO","INTENTE DE NUEVO","error"); 
   return false;
 } else if(ubicacion.length>50){                  
  sweetAlert("APELLIDOS MUY LARGOS","INSTENTE DE NUEVO","error"); 
  return false;
}   


$.ajax({
 type: "POST",
 url:  base_url()+"admin/update_consultorio",
               data: $("#actualiza_consultorio").serialize(), // serializes the form's elements.,
               success: function(respuesta) 
               {
                 if(respuesta)
                 {
                  swal("HECHO!", "CONSULTORIO ACTUALIZADO!", "success");
                  setTimeout(function() 
                  {
                    window.location.href =  base_url()+"admin/Consultorio";
                  }, 2000);     
                }
              }
            })

}

function confirmDeleteC(id){
  swal({
    title: "ESTA SEGURO DE ELIMINAR EL CONSULTORIO",
            // text: "You will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "SI, ELIMINAR AHORA!",
            closeOnConfirm: false
          }, function (isConfirm) {
            if (!isConfirm) return;
            $.ajax({
              url: base_url()+"admin/deleteConsultorio",
              type: "POST",
              data: {
                id: id
              },
              dataType: "html",
              success: function () {
                swal("HECHO!", "CONSULTORIO ELEMINADO!", "success");
                setTimeout(function() {
                  window.location.href =  base_url()+"admin/Consultorio";
                }, 2000);
              },
              error: function (xhr, ajaxOptions, thrownError) {
                swal("Error deleting!", "Please try again", "error");
              }
            });
          });
}



