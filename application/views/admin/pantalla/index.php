
<header style="height: 100px; border-bottom: 2px solid silver; margin-bottom: 10px;">
    <div class="container">
        <div class="row">
            <div class="col s6 m4 img"></div>
            <div class="col s6 m4 offset-m4 height valign-wrapper" style="text-align: center;">
                <div class="time" style="font-size: 40px; " id="liveclock">
                    <h5 id="liveclock"></h5>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="">
    <div class="row">

       <div class="col s12 m6 l6" style="height: 80vh;">


          <h5 class="center-align" style="background: darkslateblue; color: white; margin-bottom: 0%;">EN ESPERA...</h5>
          <!-- aqui tabla -->
          <div  id="conta">

          </div>

      </div>

      <!-- aquin los que van en consulta para el doctor que los llama -->
      <div class="col s12 m6 l6" style="height: 80vh;">

        <div class="row">

            <div class="col s12 video">
                <!--aqui va el video, no tienes que poner la extion del archivo-->
                <!--solo la ruta donde está esto: data-vide-bg=" arpeta/miVideo-->
                <video  class="responsive-video" style="bottom: 90%" width="880" bottom="80" autoplay loop muted>
                 <source src="<?php echo base_url();?>uploads/pantalla.mp4" type="video/mp4">
                 </video>
             </div>

             <div class="col s12">
              <!-- aqui tabla -->
              <div id="datoss">
                  
              </div>
          </div>

      </div>

  </div>
  <!-- fin llamados a consulta -->
</div>

</div>

<audio src="<?php echo base_url();?>plantillas/audio/timbre.mp3">
  
