

<body style="
background-color: #464646;

background: url(<?php echo base_url('plantillas/img/back-img.png');?>);
background-repeat: no-repeat;
background-attachment: fixed;        
background-position: center;    
background-size: cover;
">

<div class="container">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 col-xs-12">
            <h2 class="text-center white-text">
               <strong> Instituto de Seguridad y</strong> <strong>Servicios Sociales de los </strong> <strong>Trabajadores del Estado</strong> 
                <small>(ISSSTE)</small>
            </h2>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1 login-form">                   
         <form method="POST" action="<?php echo base_url()?>login/autentificarUser" style="margin-top: 55px;" class="form-horizontal col-xs-10 col-xs-offset-1" >
            <p class="error"> <?php echo $error ?> </p>
            <div class="form-group">
                <label for="exampleInputPassword1">Nombre de Usuario</label>
                <input required type="text" name="usuario"  class="form-control" id="exampleInputPassword1" placeholder="Usuario" autofocus>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Contraseña</label>
                <input name="password" required type="password" class="form-control" id="exampleInputPassword" placeholder="Contraseña">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Ingresar</button>
            </div>
        </form>
    </div>
</div>

</div>

<footer class="fter">
    <div class="container">
    <h3 class="text-center white-text">Sistema de Urgencias para Derechohabientes
     <small>(SUDH)</small>
    </h3>
 </div>
</footer>

</body>
</html>