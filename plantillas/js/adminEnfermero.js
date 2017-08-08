

      function validarEnfermeroEditar()
          {              

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
             //  else if (isNaN(cedula)) 
             // {
             //    sweetAlert("Oops...","CEDULA SOLO NUMERICO", "error");  
             //    return false;
             // }       
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
             }else{
                 return true;
                 swal("Muy Bien!","EL DOCTOR SE DIO DE ALTA EN EL SISTEMA EXITOSAMENTE!", "success");
                                
             }
                            
       

}

     function ajaxEnfermero(id) {
      
          var nombre=document.getElementById("nombre"+id).innerHTML;
          var Apellidoss=document.getElementById("Apellido"+id).innerHTML;   
          var correo=document.getElementById("Correo"+id).innerHTML;
          var cedula=document.getElementById("Cedula"+id).innerHTML;
          var usuario=document.getElementById("Usuario"+id).innerHTML;
          var contraseña=document.getElementById("Contraseña"+id).innerHTML;

          document.getElementById("idEditar").innerHTML=id+"";
          document.getElementById("idEditar").value=id;
          document.getElementById("nombreEditar").value=nombre;
          document.getElementById("apellidoEditar").value=Apellidoss;
          document.getElementById("correoEditar").value=correo;
          document.getElementById("cedulaEditar").value=cedula;
          document.getElementById("usuarioEditar").value=usuario;
          document.getElementById("passwordEditar").value=contraseña;

        
      }