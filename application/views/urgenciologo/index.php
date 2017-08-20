
<nav class="navbar navbar-inverse container-fluid">
    
    <ul id="ver" class="nav navbar-nav">
       <li class="active"><a href="<?php echo base_url();?>urgenciologo">DERECHOHABIENTE EN ESPERA</a></li>
       <li><a href="<?php echo base_url();?>urgenciologo/atendidos" style="">DERECHOHABIENTES ATENDIDOS</a></li>
    </ul>

    <ul class="nav navbar-nav navbar-right">
     <li><a href="#"><span class="glyphicon glyphicon-user"></span><?php echo " ".$nombre.' '.$apellido; ?></a></li>
     <li><a href="<?php echo base_url();?>login/cerrar_sesion"><span class="glyphicon glyphicon-log-in"></span>Salir</a></li>
    </ul>
</nav>

  <div class="container-fluid">
    <div class="row">

        <form action="<?php echo base_url();?>urgenciologo/atender" id ="atenderpa" method="post">
              <input type="hidden" name="id_doctor" id="id_doctorx" >                 
              <input type="hidden" name="id_consulta_paciente" id="id_consulta_pacientex" >  
               <input type="hidden" name="nombre" id="nombrex" >
               <input type="hidden" name="apellido" id="apellidox" >                 
               <input type="hidden" name="tipo_paciente" id="tipo_pacientex" >
               <input type="hidden" name="go" id="gox" >
               <input type="hidden" name="edad" id="edadx" >
               <input type="hidden" name="clasificacion" id="clasificacionx" >
               <input type="hidden" name="descripcion" id="descripcionx" >
               <input type="hidden" name="hora_llegada" id="hora_llegadax"> 
               <input type="hidden" name="rfc" id="rfcx">   
               <input type="hidden" name="folio" id="foliox">   
                 
        </form>
        <form action="<?php echo base_url();?>urgenciologo/atender_faltantes" id ="atender_fal" method="POST">
               <input type="hidden" name="id_doctor" id="id_doctorxx" >                 
               <input type="hidden" name="id_consulta_paciente" id="id_consulta_pacientexx" >  
               <input type="hidden" name="nombre" id="nombrexx" >
               <input type="hidden" name="apellido" id="apellidoxx" >
               <input type="hidden" name="go" id="goxx" >
               <input type="hidden" name="edad" id="edadxx" >
               <input type="hidden" name="tipo_paciente" id="tipo_pacientexx">               
               <input type="hidden" name="clasificacion" id="clasificacionxx" >
               <input type="hidden" name="descripcion" id="descripcionxx" >
               <input type="hidden" name="hora_llegada" id="hora_llegadaxx">   
               <input type="hidden" name="rfc" id="rfcxx">  
               <input type="hidden" name="folio" id="folioxx"> 
       </form>

       <div class="table-responsive" id="recuperaa">
                  
       </div> 

       <div class="panel panel-primary">
         <div class="panel-heading text-center" style="font-family: Arial;">LISTA DERECHOHABIENTES EN ESPERA</div>
         <div class="table-responsive" id="show">

         </div> 
       </div>
    </div>
  </div>

  <script type="text/javascript">
        
    $(document).ready(function() {
        
      function getRandValue(){
            //inicio ajax 1

            //inicio ajax 2
            $.ajax({
              type: "POST",
              url: "<?php echo base_url();?>urgenciologo/ajax_Urgenciologo",
                //data: dataString,
                success: function(data) {
                    $('#show').html(data);
                }
            }); //fin ajax2
        }
        getRandValue();
        setInterval(getRandValue, 1000);
        setInterval(recuperarDatos, 1000);

      function recuperarDatos()
        {
          
            $.ajax({
              type: "POST",
              url: "<?php echo base_url();?>urgenciologo/pendientes_ajax",
                
                success: function(data) {
                  //se imprime desde la propiedad de jquery html en el id "show" que es un div
                    $('#recuperaa').html(data);
                }
            }); 
           }

         });


        function atender(id) {
          
          var ids=document.getElementById("id_doctor"+id).value;

          document.getElementById("id_doctorx").value=ids;
          
          var name=document.getElementById("nombre"+id).value;
          document.getElementById("nombrex").value=name;
          document.getElementById("id_consulta_pacientex").value=document.getElementById("id_consulta_paciente"+id).value;
          document.getElementById("apellidox").value=document.getElementById("apellido"+id).value;
        
          document.getElementById("rfcx").value=document.getElementById("rfc"+id).value;
         
         document.getElementById("tipo_pacientex").value=document.getElementById("tipo_paciente"+id).value;

          document.getElementById("gox").value=document.getElementById("go"+id).value;
           
          var edad = document.getElementById("edad"+id).value;
              
         document.getElementById("edadx").value=edad;

          document.getElementById("clasificacionx").value=document.getElementById("clasificacion"+id).value;
          document.getElementById("hora_llegadax").value=document.getElementById("hora_llegada"+id).value;
          document.getElementById("descripcionx").value=document.getElementById("descripcion"+id).value;
           document.getElementById("foliox").value=document.getElementById("folio"+id).value;

          document.getElementById("atenderpa").submit();
        }

        function atender_prioridad(id) {
          
          var ids=document.getElementById("id_doctor"+id).value;
          document.getElementById("id_doctorxx").value=ids;
          var name=document.getElementById("nombre"+id).value;
        
          document.getElementById("nombrexx").value=name;
          document.getElementById("id_consulta_pacientexx").value=document.getElementById("id_consulta_paciente"+id).value;
          document.getElementById("apellidoxx").value=document.getElementById("apellido"+id).value;
          document.getElementById("rfcxx").value=document.getElementById("rfc"+id).value;
          document.getElementById("tipo_pacientexx").value=document.getElementById("tipo_paciente"+id).value;
          document.getElementById("edadxx").value=document.getElementById("edad"+id).value;
          document.getElementById("goxx").value=document.getElementById("go"+id).value;
          document.getElementById("clasificacionxx").value=document.getElementById("clasificacion"+id).value;
          document.getElementById("hora_llegadaxx").value=document.getElementById("hora_llegada"+id).value;
          document.getElementById("descripcionxx").value=document.getElementById("descripcion"+id).value;
          document.getElementById("folioxx").value=document.getElementById("folio"+id).value;
          document.getElementById("atender_fal").submit();
        }

    </script>

</body>
</html>