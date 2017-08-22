

$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').focus()
});

$('#myModalD').on('shown.bs.modal', function () {
  $('#myInput').focus()
});

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

   
  function resetear_reg_goctor() {
     $('#form_agregaD')[0].reset()
   }

   function verficUsername(){
    
    $.ajax({
     type: "POST",
     url: base_url() + "admin/buscaUsername",
       data: $("#form_agregaD").serialize(), // serializes the form's elements.,
       success: function(respuesta) 
       {
        if(respuesta==1)
        {
          swal("Error!", "USUARIO EXISTENTE, PRUEBE CON OTRO", "error");
        }
      }
    }) //fin ajax2
  }

  function verficUsernameD_Actualizar(){
    
    $.ajax({
     type: "POST",
     url: base_url() + "admin/buscaUsername",
       data: $("#editarDordor").serialize(), // serializes the form's elements.,
       success: function(respuesta) 
       {
        if(respuesta==1)
        {
          swal("Error!", "USUARIO EXISTENTE, PRUEBE CON OTRO", "error");
        }
      }
    }) //fin ajax2
  }

  function insert_doctor(){
    var nombre   = document.getElementById('nombreValidar').value;      
    if(nombre === ""){
      sweetAlert("Oops...","NOMBRE ES UN DATO OBLIGATORIO","error");              
      return false;               
    }else if(nombre.length>30){
      sweetAlert("Oops...","NOMBRE ES MUY LARGO","error");   
    }      
    var apellido = document.getElementById('apellidoValidar').value;
    if(apellido === ""){               
     sweetAlert("Oops...","APELLIDO ES UN DATO OBLIGATORIO","error"); 
     return false;
   } else if(apellido.length>50){                  
    sweetAlert("Oops...","APELLIDOS MUY LARGOS","error"); 
    return false;
  }   
  var expreciones = /\w+@\w+\.+[a-z]/;            
  var correo   = document.getElementById('correoValidar').value;
  if(correo === ""){              
   sweetAlert("Oops...", "CORREO ES UN DATO OBLIGATORIO", "error");
   return false;
 }   else if(nombre.length>80){
   sweetAlert("Oops...", "EL CORREO ES MUY LARGO", "error");                  
   return false;
 } else if(!expreciones.test(correo)){
  sweetAlert("Oops...","EL CORREO INTRUDUCIDO NO ES VALIDO", "error");
  return false;
}
var cedula   = document.getElementById('cedulaValidar').value;
if(cedula === ""){
  sweetAlert("Oops...","CEDULA ES UN DATO OBLIGATORIO", "error");               
  return false;
}   else if(cedula.length>30){
  sweetAlert("Oops...","LA CEDULA INTRODUCIDA SOBREPASA LOS CARACTERES ESTANDARES", "error");                  
  return false;
} 

var opciones = document.getElementById("selectConsultorioValida").selectedIndex;
if( opciones == null) {
  sweetAlert("Oops...","SELECCIONES CONSULTORIO PARA EL DOCTOR", "error");                
  return false;
}else if(opciones === 0 ){
  sweetAlert("Oops...","SELECCIONES CONSULTORIO PARA EL DOCTOR", "error");   
  
  return false;
}

var usuario  = document.getElementById('usuarioValidar').value;
if(usuario === ""){
 sweetAlert("Oops...","USUARIO ES UN DATO OBLIGATORIO", "error");              
 return false;
}  else if(usuario.length>30){
  sweetAlert("Oops...","EL NOMBRE DE USUARIO INTRODUCIDO SOBREPASA EL NUMERO DE CARACTERES PERMITIDOS", "error");                  
  return false;
}  
var password = document.getElementById('passwordValidar').value;
if(password === ""){
  sweetAlert("Oops...","CONTRASEÑA ES UN DATO OBLIGATORIO", "error");                    
  return false;
}  else if(password.length>30){
  sweetAlert("Oops...","CONTRASEÑA MUY LARGA", "error");                     
  return false;
}


$.ajax({
 type: "POST",
 url: base_url() + "admin/new_doctor",
             data: $("#form_agregaD").serialize(), // serializes the form's elements.,
             success: function(respuesta) 
             {
               if(respuesta)
               {
                swal("HECHO!", "DOCTOR AGREGADOR!", "success");
                setTimeout(function() 
                {
                  window.location.href = base_url()+"admin";
                }, 2000);     
              }
            }
          });

}

function ajaxdoctor(id) 
{
  var nombre=document.getElementById("nombre"+id).innerHTML;
  var Apellidoss=document.getElementById("Apellido"+id).innerHTML;
  var correo=document.getElementById("Correo"+id).innerHTML;
  var cedula=document.getElementById("Cedula"+id).innerHTML;
        // var consultorio=document.getElementById("consultorio"+id).innerHTML;
        var usuario=document.getElementById("Usuario"+id).innerHTML;
        var contraseña=document.getElementById("Password"+id).innerHTML;

        document.getElementById("idEditar").innerHTML=id;
        document.getElementById("idEditar").value=id;
        document.getElementById("nombreEditar").value=nombre;
        document.getElementById("apellidoEditar").value=Apellidoss;
        document.getElementById("correoEditar").value=correo;
        document.getElementById("cedulaEditar").value=cedula;
        // document.getElementById("consultorioEditar").value=consultorio;
        document.getElementById("usuarioEditar").value=usuario;
        document.getElementById("passwordEditar").value=contraseña;

      }


      function Update_doctor(){

        var nombre   = document.getElementById('nombreEditar').value;      
        if(nombre === ""){
          sweetAlert("Oops...","NOMBRE ES UN DATO OBLIGATORIO","error");              
          return false;               
        }else if(nombre.length>30){
          sweetAlert("Oops...","NOMBRE ES MUY LARGO","error");
        }      
        var apellido = document.getElementById('apellidoEditar').value;
        if(apellido === ""){               
         sweetAlert("Oops...","APELLIDO ES UN DATO OBLIGATORIO","error"); 
         return false;
       } else if(apellido.length>50){                  
        sweetAlert("Oops...","APELLIDOS MUY LARGOS","error"); 
        return false;
      }   
      var expreciones = /\w+@\w+\.+[a-z]/;            
      var correo   = document.getElementById('correoEditar').value;
      if(correo === ""){              
       sweetAlert("Oops...", "CORREO ES UN DATO OBLIGATORIO", "error");
       return false;
     }   else if(nombre.length>80){
       sweetAlert("Oops...", "EL CORREO ES MUY LARGO", "error");                  
       return false;
     } else if(!expreciones.test(correo)){
      sweetAlert("Oops...","EL CORREO INTRUDUCIDO NO ES VALIDO", "error");
      return false;
    }
    var cedula   = document.getElementById('cedulaEditar').value;
    if(cedula === ""){
      sweetAlert("Oops...","CEDULA ES UN DATO OBLIGATORIO", "error");               
      return false;
    }   else if(cedula.length>30){
      sweetAlert("Oops...","LA CEDULA INTRODUCIDA SOBREPASA LOS CARACTERES ESTANDARES", "error");                  
      return false;
    }
    
    var opciones = document.getElementById("consultorioEditar").selectedIndex;
    if( opciones == null) {
      sweetAlert("Oops...","SELECCIONES CONSULTORIO PARA EL DOCTOR", "error");                
      return false;
    }else if(opciones === 0 ){
      sweetAlert("Oops...","SELECCIONES CONSULTORIO PARA EL DOCTOR", "error");   
      
      return false;
    }

    var usuario  = document.getElementById('usuarioEditar').value;
    if(usuario === ""){
     sweetAlert("Oops...","USUARIO ES UN DATO OBLIGATORIO", "error");              
     return false;
   }  else if(usuario.length>30){
    sweetAlert("Oops...","EL NOMBRE DE USUARIO INTRODUCIDO SOBREPASA EL NUMERO DE CARACTERES PERMITIDOS", "error");                  
    return false;
  }  
  var password = document.getElementById('passwordEditar').value;
  if(password === ""){
    sweetAlert("Oops...","CONTRASEÑA ES UN DATO OBLIGATORIO", "error");                    
    return false;
  }  else if(password.length>30){
    sweetAlert("Oops...","CONTRASEÑA MUY LARGA", "error");                     
    return false;
  }                       

  
  $.ajax({
   type: "POST",
   url: base_url() + "admin/update_doctor",
             data: $("#editarDordor").serialize(), // serializes the form's elements.,
             success: function(respuesta) 
             {
               if(respuesta)
               {
                swal("HECHO!", "DATOS ACTUALIZADOS!", "success");
                setTimeout(function() 
                {
                  window.location.href = base_url()+"admin";
                }, 2000);     
              }
            }
          });
  
}


function confirmDeleteD(id){
  
 
  swal({
   title: "ESTA SEGURO DE ELIMINAR DOCTOR",
         // text: "You will not be able to recover this imaginary file!",
         type: "warning",
         showCancelButton: true,
         confirmButtonColor: "#DD6B55",
         confirmButtonText: "SI, ELIMINAR AHORA!",
         closeOnConfirm: false
       }, function (isConfirm) {
        if (!isConfirm) return;
        $.ajax({
          url: base_url() + "admin/deleteDoctor",
          type: "POST",
          data: {
            id: id
          },
          dataType: "html",
          success: function () {
            swal("HECHO!", "DOCTOR ELEMINADO!", "success");
            setTimeout(function() {
              window.location.href = base_url()+"admin";
            }, 2000);
          },
          error: function (xhr, ajaxOptions, thrownError) {
            swal("Error deleting!", "Please try again", "error");
          }
        });
      });
}

