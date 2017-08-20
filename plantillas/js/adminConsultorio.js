

    function validarConsultorioEditar()
          {              

           var nombre   = document.getElementById('nombreEditar').value;      
             if(nombre === ""){
              sweetAlert("NOMBRE CONSULTORIO OBLIGATORIO","INSTENTE DE NUEVO","error");              
               return false;   

             }else if(nombre.length>30){
                  sweetAlert("NOMBRE MUY LARGO","INSTENTE DE NUEVO","error"); 
             } 

           var ubicacion = document.getElementById('ubicacionEditar').value;
             if(ubicacion === ""){               
               sweetAlert("UBICACION OBLIGATORIO","INTENTE DE NUEVO","error"); 
               return false;

             } else if(ubicacion.length>50){                  
                  sweetAlert("APELLIDOS MUY LARGOS","INSTENTE DE NUEVO","error"); 
                  return false;
             }   
                            
        return swal("Muy Bien!","EL CONSULTORIO SE DIO DE ALTA EN EL SISTEMA EXITOSAMENTE!", "success");         
                  
    }


        function ajaxConsultorio(id) {
            var nombre=document.getElementById("nombre"+id).innerHTML;
            var ubicacion=document.getElementById("ubicacion"+id).innerHTML;

            document.getElementById("idEditar").innerHTML=id+"";
            document.getElementById("idEditar").value=id;
            document.getElementById("nombreEditar").value=nombre;
            document.getElementById("ubicacionEditar").value=ubicacion;


            
        }