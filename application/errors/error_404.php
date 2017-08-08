
<!DOCTYPE html>
<html lang="en">
<head>
<title>404 Page Not Found</title>
<link rel="stylesheet" href="<?php echo base_url();?>plantillas/css/bootstrap.css">
   <link rel="icon" type="image/png" href="<?php echo base_url();?>plantillas/img/logo.jpg"/>
    <script type="text/javascript" src="<?php echo base_url();?>plantillas/js/jquery.min.js"></script>
<style>
		.ops{
			font-size: 60px;
		}
	</style>
</head>

<body style="background: #ededed;">


	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-xs-12 col-sm-offset-3">
				<div class="text-center">
					<img src="<?php echo base_url();?>plantillas/img/404.png" class="img-responsive" alt="">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 col-xs-12 col-sm-offset-3" style="margin-top: -70px;">
				<div class="text-center">
					<h1>Oopss!!</h1>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-8 col-xs-12 col-sm-offset-2" style="margin-bottom: 20px;">
				<div class="text-center">
					<h3>Lo sentimos, pero la página que está buscando no existe.</h3>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-8 col-xs-12 col-sm-offset-2">
				<div class="text-center">
					<button type="button"  onclick="error();" class="btn btn-primary">Ir al Inicio</button>
				</div>
			</div>
		</div>
	</xsv>
	</div>

<script type="text/javascript">
	
 function error(){
				
 window.location.href = "<?php echo base_url();?>login/error";
				
}
</script>
</body>
</html>