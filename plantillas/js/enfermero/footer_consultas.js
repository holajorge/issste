function base_url() {
  var pathparts = location.pathname.split('/');
  if (location.host == '192.168.0.13') {
          var url = location.origin+'/'+pathparts[1].trim('/')+'/'; // http://localhost/myproject/
      }else{
          var url = location.origin; // http://stackoverflow.com
      }
      return url;
  }


function doSearch()
{
 var tableReg = document.getElementById('datos');
 var searchText = document.getElementById('searchTerm').value.toLowerCase();
 var cellsOfRow="";
 var found=false;
 var compareWith="";

               // Recorremos todas las filas con contenido de la tabla
               for (var i = 1; i <= tableReg.rows.length; i++)
               {
                cellsOfRow = tableReg.rows[i].getElementsByTagName('th');
                found = false;
                 // Recorremos todas las celdas
                 for (var j = 0; j < cellsOfRow.length && !found; j++)
                 {
                  compareWith = cellsOfRow[j].innerHTML.toLowerCase();
         // Buscamos el texto en el contenido de la celda
         if (searchText.length == 0 || (compareWith.indexOf(searchText) > -1))
         {
           found = true;
         }
       }
       if(found)
       {
         tableReg.rows[i].style.display = '';
       } else {
      // si no ha encontrado ninguna coincidencia, esconde la
      // fila de la tabla
      tableReg.rows[i].style.display = 'none';
    }
  }
}

   function registar_nuevo() {
      window.location.href = base_url()+"enfermero/registro";
   }

    function quitarReadOnly()
    {
            // Eliminamos el atributo de solo lectura
            
            // Eliminamos la clase que hace que cambie el color
            
            $("#nombreEditar").removeAttr("readonly");
            $("#nombreEditar").removeClass("readOnly");

            $("#apellidoEditar1").removeAttr("readonly");
            $("#apellidoEditar1").removeClass("readOnly");

            $("#apellidoEditar2").removeAttr("readonly");
            $("#apellidoEditar2").removeClass("readOnly");

            $("#rfcEditar").removeAttr("readonly");
            $("#rfcEditar").removeClass("readOnly");

            $("#sexoEditar").removeAttr("readonly");
            $("#sexoEditar").removeClass("readOnly");
            $("#sexoEditar").removeClass("disabled"); 

            $("#vigenciaEditar").removeAttr("readonly");
            $("#vigenciaEditar").removeClass("readOnly"); 
            $("#vigenciaEditar").removeClass("disabled"); 
          }

          function quitarReadOnlyP()
          {
            // Eliminamos el atributo de solo lectura
            
            // Eliminamos la clase que hace que cambie el color
            
            $("#nombreEditar").removeAttr("readonly");
            $("#nombreEditar").removeClass("readOnly");

            $("#apellidoEditar").removeAttr("readonly");
            $("#apellidoEditar").removeClass("readOnly");

            $("#apellidoEditar1").removeAttr("readonly");
            $("#apellidoEditar1").removeClass("readOnly");

            $("#sexoEditar").removeAttr("readonly");
            $("#sexoEditar").removeClass("readOnly");
            $("#sexoEditar").removeAttr("disabled");

            $("#rfcEditar").removeAttr("readonly");
            $("#rfcEditar").removeClass("readOnly");

            $("#vigenciaEditar").removeAttr("readonly");
            $("#vigenciaEditar").removeClass("readOnly"); 
            $("#vigenciaEditar").removeAttr("disabled");
          }


          function ajaxnewpacientes(id) 
          {
            var nombre=document.getElementById("nombre"+id).innerHTML;
            var ape_pate=document.getElementById("ape_pate"+id).innerHTML;
            var ape_mate=document.getElementById("ape_mate"+id).innerHTML;
            var rfc=document.getElementById("rfc"+id).innerHTML;
            var sexo=document.getElementById("sexo"+id).innerHTML;
            var vigencia=document.getElementById("vigencia"+id).innerHTML;

            // var vigencia=document.getElementById("vigencia"+id).innerHTML;
            document.getElementById("idEditar").innerHTML=id+"";
            document.getElementById("idEditar").value=id;
            document.getElementById("nombreEditar").value=nombre;
            document.getElementById("apellidoEditar1").value=ape_pate;
            document.getElementById("apellidoEditar2").value=ape_mate;
            document.getElementById("rfcEditar").value=rfc;
            document.getElementById("sexoEditar").value=sexo;
            document.getElementById("vigenciaEditar").value=vigencia;

           // document.getElementById("vigenciaEditar").value=vigencia;
         }

        function ajaxConsultas(id)
           {

             var nombre=document.getElementById("nombre"+id).innerHTML;
             var ape_pate=document.getElementById("ape_pate"+id).innerHTML;
             var ape_mate=document.getElementById("ape_mate"+id).innerHTML;
             var rfc=document.getElementById("rfc"+id).innerHTML;
             var sexo=document.getElementById("sexo"+id).innerHTML;
             var vigencia=document.getElementById("vigencia"+id).innerHTML;
             var edad=document.getElementById("edad"+id).innerHTML;
             var fecha=document.getElementById("fecha_nacimiento"+id).innerHTML;

             
             if (edad <= 8) 
             {
              var vida = "NIÑO"; 
              $('#nover').hide(); 
              
            }
            else if (edad >= 9 && edad <=18) 
            {
              var vida = "ADOLECENTE"; 
              $('#nover').show(); 

            }               
            else if (edad >= 19 && edad <=32) 
            {
              var vida = "JOVEN";
              $('#nover').show();  

            }
            else if (edad >= 33) 
            {
              var vida = "ADULTO"; 
              $('#nover').show(); 

            }
            document.getElementById("idEditar").innerHTML=id+"";
            document.getElementById("idEditar").value=id;
            document.getElementById("nombreEditar").value=nombre;
            document.getElementById("apellidoEditar1").value=ape_pate;
            document.getElementById("apellidoEditar2").value=ape_mate;
            document.getElementById("rfcEditar").value=rfc;
            document.getElementById("sexoEditar").value=sexo;
            document.getElementById("vigenciaEditar").value=vigencia;
            document.getElementById("edadValidar").value=vida;
            document.getElementById("edadValidarC").value=edad;
            document.getElementById("fecha_nacimientoC").value=fecha;
            $('.nav-tabs a[href="#seccion2"]').tab('show');

          }

          function ajaxeditarUrgencia(id) {

            var nombre=document.getElementById("nombre"+id).innerHTML;            
            var apellido=document.getElementById("apellido"+id).innerHTML;             
            var tipo_paciente=document.getElementById("tipo_paciente"+id).innerHTML;              
            var hora_llegada = document.getElementById("hora_llegada"+id).innerHTML;                          
            var clasificacion=document.getElementById("clasificacion"+id).innerHTML;    
            var descripcion=document.getElementById("descripcion"+id).innerHTML;

            document.getElementById("idEditar").innerHTML=id+"";
            document.getElementById("idEditar").value=id;              
            document.getElementById("nombreEditar").value=nombre;
            document.getElementById("apellidoEditar").value=apellido;                            
            document.getElementById("clasificacionEditar").value=clasificacion;
            document.getElementById("descripcionEditar").value=descripcion;

          }

          function insert_paciente(){

            
            var opciones = document.getElementById("clasificacionValidar").selectedIndex;
            if( opciones == null) {
              sweetAlert("Oops...","SELECCIONES CLASIFICACION DEL DERECHOHABIENTE", "error");                
              return false;
            } else if(opciones === 0 ){
              sweetAlert("Oops...","SELECCIONES CLASIFICACION DEL DERECHOHABIENTE", "error");                   
              return false;
            }
            
            var apellido = document.getElementById('folioValidar').value;
            if(apellido === ""){               
             sweetAlert("Oops...","FOLIO ES UN DATO OBLIGATORIO","error"); 
             return false;
           }           
           var rfc   = document.getElementById('descripcionValidar').value;
           if(rfc === ""){
            sweetAlert("Oops...","DESCRIPCION ES UN DATO OBLIGATORIO", "error");               
            return false;
          }  

          $('#clasificacionValidar').removeAttr('disabled'); 
          $('#sexoEditar').removeAttr('disabled');   
          $('#vigenciaEditar').removeAttr('disabled');     


          $.ajax({
           type: "POST",
           url: base_url()+"enfermero/insertar_consulta",
           data: $("#insertar_consulta").serialize(),
           success: function(respuesta) 
           {
             if(respuesta)
             {
               swal("HECHO!", "DERECHOHABIENTE AGREGADOR!", "success");
               setTimeout(function()
               {
                 window.location.href = base_url()+"enfermero/consultass";
               },
               2000);     
             }
           }
         });
        }     



        function insert_pacientePrevia(){

         
          var opciones = document.getElementById("clasificacionValidar1").selectedIndex;
          if( opciones == null) {
            sweetAlert("Oops...","SELECCIONES CLASIFICACION DEL DERECHOHABIENTE", "error");                
            return false;
          } else if(opciones === 0 ){
            sweetAlert("Oops...","SELECCIONES CLASIFICACION DEL DERECHOHABIENTE", "error");                   
            return false;
          }
          
          var folio = document.getElementById('folioValidar1').value;
          if(folio === ""){               
           sweetAlert("Oops...","FOLIO ES UN DATO OBLIGATORIO","error"); 
           return false;
         }           
         var descripcionD   = document.getElementById('descripcionValidar1').value;
         if(descripcionD === ""){
          sweetAlert("Oops...","DESCRIPCION ES UN DATO OBLIGATORIO", "error");               
          return false;
        }   

        $('#clasificacionValidar1').removeAttr('disabled'); 
        $('#sexoEditar').removeAttr('disabled');   
        $('#vigenciaEditar').removeAttr('disabled');     

        $.ajax({
         type: "POST",
         url: base_url()+"enfermero/insertar_consulta",
         data: $("#insertar_consultaPrevia").serialize(),
         success: function(respuesta) 
         {
           if(respuesta)
           {
             swal("HECHO!", "DERECHOHABIENTE AGREGADOR!", "success");
             setTimeout(function()
             {
               window.location.href = base_url()+"enfermero/consultass";
             },
             2000);     
           }
         }
        });
        }

      function OpenInNewTab()  
        {

         var url = base_url()+"pantalla";
         
         var nuevaVentana = (window.open(url, '','fullscreen=yes'));
         if (nuevaVentana ) 
         {
          nuevaVentana.focus();
        }

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
       url: base_url() + "enfermero/mostrar",
       type: "POST",
    
       data: {buscar:valorBuscar,nropagina:pagina,cantidad:cantidad},
       dataType:"json",
       success:function(response){
      

       filas = "";
       $.each(response.clientes,function(key,item){
        filas+=
        "<tr> <td style=\"text-align: left;\"> <label id=\'nombre"+item.id_paciente+"\'>"+item.nombre+"</label></td><td style=\"text-align: left;\"><label id=\"ape_pate"+item.id_paciente+"\">"+item.ape_pate+"</label></td><td style=\"text-align: left;\"><label id=\"ape_mate"+item.id_paciente+"\">"+item.ape_mate+"</label></td><td><label id=\"edad"+item.id_paciente+"\">"+item.edad+"</label></td> <td><label id=\"sexo"+item.id_paciente+"\">"+item.sexo+"</label></td><td> <label id=\"fecha_nacimiento"+item.id_paciente+"\">"+item.fecha_nacimiento+"</label></td><td> <label id=\"rfc"+item.id_paciente+"\">"+item.rfc+"</label></td><td> <label id=\"vigencia"+item.id_paciente+"\">"+item.vigencia+"</label></td><td><button type=\"button\" onclick=\"ajaxConsultas("+item.id_paciente+")\" class='col-gl-9 btn btn-primary text-center'>PROGRAMAR URGENCIA</button></td></tr>"      
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