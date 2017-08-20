<!DOCTYPE html>
<html lang="en">

<head>
    <title>Registro Pacientes | TRIAGE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="<?php echo base_url();?>plantillas/img/logo.jpg" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="<?php echo base_url();?>plantillas/css/admin.css">
    <link href="<?php echo base_url();?>plantillas/css/bootstrap.css" rel="stylesheet">
 
</head>

<body>
    <div class="cabeza">
        <div class="row">
            <div class="col-xs-12 col-sm-3 logo">
            </div>
            <div class="col-xs-12 col-sm-6">
                <h1 class="text-center">Registro de Pacientes</h1>
            </div>
            <div class="hidden-xs col-sm-3 logo">

            </div>
        </div>
    </div>
    <nav class="navbar navbar-inverse container">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand pantalla" href="#">SOAD</a>
            </div>
            <ul class="nav navbar-nav">
               <li ><a href="<?php echo base_url();?>enfermero/mostarPaciente">Paciente</a></li>
               <li ><a href="<?php echo base_url();?>enfermero/consultas">Consultas</a></li>
                <li class="active"><a href="<?php echo base_url();?>enfermero/registro">Registro paciente sin nada</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><span class="glyphicon glyphicon-user"></span>yorch</a></li>
                <li><a href="<?php echo base_url();?>login/usuarios/cerrar_sesion"><span class="glyphicon glyphicon-log-in"></span>Salir</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">        
                    <div class="row">
                        <div class="col-md-12">
                            <div role="tappanel">                      
                            <h2>Datos del Paciente</h2>
                            <form action="<?php base_url();?>insertar_consultaSIN" class="form-horizontal" method="post">
                           <!--   <input type="hidden" name="id" id="idEditar" value=""> -->
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Nombre:</label>
                                    <div class="col-sm-6">
                                   
                                        <input type="text"  name="nombre" class="form-control" id="nombreEditar" placeholder="Ingrese Nombre del Paciente">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Apellidos:</label>
                                    <div class="col-sm-6">
                                        <input type="text"  name="apellido" class="form-control" id="apellidoEditar" placeholder="Ingrese Apellidos del Paciente">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">RFC:</label>
                                    <div class="col-sm-6">
                                        <input type="text"  name="rfc" class="form-control" id="rfcEditar" placeholder="Ingrese RFC del Paciente">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">FOLIO:</label>
                                    <div class="col-sm-6">
                                        <input type="text"   name="folio" class="form-control" id="folioEditar" placeholder="Ingrese Folio del Paciente">
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Tipo Paciente:</label>
                                    <div class="col-sm-6">
                                        <select name="tipo_paciente" class="form-control"> 
                                           <option selected>Seleccine Tipo Paciente</option>
                                           <option  value="1">NIÑO</option>
                                           <option  value="2">ADULTO</option>
                                           <option  value="3">G-O</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Clasificación:</label>
                                    <div class="col-sm-6">
                                        <select name="clasificacion"  class="form-control"> 
                                           <option selected>Seleccine la Clasificación del Paciente</option>
                                           <option  value="1">VERDE</option>
                                           <option  value="2">AMARILLO</option>
                                           <option  value="3">ROJO</option>
                                        </select>
                                    </div>
                                </div>
        
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-3">
                                        <button type="submit" value="submit" class="btn btn-primary btn-lg btn-block">Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
       
    <script src="http://code.jquery.com/jquery.js"></script>

     <script src="<?php echo base_url();?>plantillas/js/bootstrap.js"> </script>

</body>

</html>