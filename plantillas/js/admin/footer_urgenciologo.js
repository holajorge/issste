

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

    
  function resetear_reg_urgenciologo() {
     $('#form_agregaU')[0].reset()
   }

   function verficUsernameU(){
    
    $.ajax({
     type: "POST",
     url: base_url()+"admin/buscaUsername",
       data: $("#form_agregaU").serialize(), // serializes the form's elements.,
       success: function(respuesta) 
       {
         if(respuesta==1)
         {
          swal("Error!", "Usuario existente!", "error");
          
        }
      }
    }) 
  }

  function buscaUsernameU_Actualizar(){
    
    $.ajax({
     type: "POST",
     url: base_url()+"admin/buscaUsername",
       data: $("#editarUrgenciologo").serialize(), // serializes the form's elements.,
       success: function(respuesta) 
       {
         if(respuesta==1)
         {
          swal("Error!", "Usuario existente!", "error");
          
        }
      }
  }) //fin ajax2
  }


  function insert_Urgenciologo(){

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

var opciones = document.getElementById("opcionValidar").selectedIndex;
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
 url: base_url()+"admin/new_urgenciologo",
       data: $("#form_agregaU").serialize(), // serializes the form's elements.,
       success: function(respuesta) 
       {
         if(respuesta)
         {
          swal("HECHO!", "URGENCIOLOGO AGREGADO!", "success");
          
          setTimeout(function() 
          {
           window.location.href = base_url()+"admin/urgenciologo";
       // $('#form_agregaU')[0].reset();
     }, 2000);   
        }
      }
  }) //fin ajax2

}


function ajaxurgenciologo(id) {

  var nombre=document.getElementById("nombre"+id).innerHTML;
  var Apellidoss=document.getElementById("Apellido"+id).innerHTML;
  var correo=document.getElementById("Correo"+id).innerHTML;
  var cedula=document.getElementById("Cedula"+id).innerHTML;
            //var id_consultorio=document.getElementById("id_consultorio"+id).innerHTML;
            var usuario=document.getElementById("Usuario"+id).innerHTML;
            var contraseña=document.getElementById("password"+id).innerHTML;

            document.getElementById("idEditar").innerHTML=id+"";
            document.getElementById("idEditar").value=id;
            document.getElementById("nombreEditar").value=nombre;
            document.getElementById("apellidoEditar").value=Apellidoss;
            document.getElementById("correoEditar").value=correo;
            document.getElementById("cedulaEditar").value=cedula;
            //document.getElementById("id_consultorio").value=id_consultorio;
            document.getElementById("usuarioEditar").value=usuario;
            document.getElementById("passwordEditar").value=contraseña;            
          }


          function update_Urgenciologo(){

           var nombre   = document.getElementById('nombreEditar').value;      
           if(nombre === ""){
            sweetAlert("Oops...","NOMBRE ES UN DATO OBLIGATORIO","error");              
            return false;               
          }else if(nombre.length>50){
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
      }else if(opciones == 0 ){
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
     url: base_url()+"admin/updateUrgenciologo",
       data: $("#editarUrgenciologo").serialize(), // serializes the form's elements.,
       success: function(respuesta) 
       {
         if(respuesta)
         {
          swal("HECHO!", "DATOS ACTUALIZADOS!", "success");
          setTimeout(function() 
          { 
            window.location.href = base_url()+"admin/urgenciologo"; 
            
          }, 2000);     
        }
      }
  }); //fin ajax2
    
  }

  function confirmDeleteU(id){

    swal({
      title: "ESTA SEGURO DE ELIMINAR URGENCIOLOGO",
        // text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "SI, ELIMINAR AHORA!",
        closeOnConfirm: false
      }, function (isConfirm) {
        if (!isConfirm) return;
        $.ajax({
          url: base_url()+"admin/eliminarUrgenciologo",
          type: "POST",
          data: {
            id: id
          },
          dataType: "html",
          success: function () {
            swal("HECHO!", "URGENCIOLOGO ELEMINADO!", "success");
            setTimeout(function() {
              window.location.href = base_url()+"admin/urgenciologo";
            }, 2000);
          },
          error: function (xhr, ajaxOptions, thrownError) {
            swal("Error deleting!", "Please try again", "error");
          }
        });
      });
  }
