	<nav class="navbar navbar-inverse container">
 <div class="container-fluid">
   <div class="navbar-header">
    <a class="navbar-brand pantalla" href="javascript: OpenInNewTab()">SUDH</a>
  </div>
  <ul class="nav navbar-nav">
    <li class="active"><a href="<?php echo base_url();?>enfermero/consultass">EXISTENTE</a></li>
    <li><a href="<?php echo base_url();?>enfermero/registro">REGISTRAR DERECHOHABIENTE</a></li>            
    <li><a href="<?php echo base_url();?>enfermero/espera">PACIENTES EN ESPERA</a></li>
    <li ><a href="<?php echo base_url();?>enfermero/consultorio">PACIENTES EN CONSULTA</a></li>
          <li ><a href="<?php echo base_url();?>enfermero/no_asistio">FALTANTES</a></li>
  </ul>
  <ul class="nav navbar-nav navbar-right">
   <li><a href="#"><span class="glyphicon glyphicon-user"></span><?php echo " ".$nombre.' '.$apellido; ?></a></li>
   <li><a href="<?php echo base_url();?>login/cerrar_sesion"><span class="glyphicon glyphicon-log-in"></span>Salir</a></li>
 </ul>
</div>
</nav>

	<div class="container">
		<div class="row">
			
			<div class="row">
		    <br>
		    <div class="col-lg-8"></div>
		    <div class="col-lg-4">
		      <input type="text" class="form-control" id="searchTerm" onkeyup="doSearch()" name="busqueda" placeholder="Buscar Doctor">
		    </div>
		  </div>

		</div>
		<br>
		<div class="row">		
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h4 class="text-center">Lista de Pacientes</h4>
					</div>
					<div class="panel-body">
						<p>
							<strong>Mostrar por : </strong>
							<select name="cantidad" id="cantidad">
								<option value="5">5</option>
								<option value="1000">1000</option>
								<option value="2000">3000</option>
								<option value="5000">5000</option>
							</select>
						</p>
						<table id="tbclientes" class="table table-bordered">
							<thead>
								<tr>
									<th>Nombre</th>
									<th>APE PATERNO</th>
									<th>APE MATERNO</th>
									<th>SEXO</th>
									<th>FECHA NACIMIENTO</th>
									<th>RFC</th>
									<th>VIGENCIA</th>
									<th>acciones</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
						<div class="text-center paginacion" >
							
						</div>
					</div>
				</div>
			
		</div>
	</div>
	<script src="<?php echo base_url();?>plantillas/js/jquery-1.11.3.min.js"></script>
	<script src="<?php echo base_url();?>plantillas/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>plantillas/js/paginacion.js"></script>
	<script src="<?php echo base_url();?>plantillas/js/enfermero.js"></script>
</body>
</html>
