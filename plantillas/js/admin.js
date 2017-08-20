
function base_url() {
  var pathparts = location.pathname.split('/');
  if (location.host == '192.168.0.13') {
          var url = location.origin+'/'+pathparts[1].trim('/')+'/'; // http://localhost/myproject/
      }else{
          var url = location.origin; // http://stackoverflow.com
      }
      return url;
  }

function abrirPantalla()  
{

   var url = base_url()+"pantalla";
   
   var nuevaVentana = (window.open(url, '','fullscreen=yes'));
   if (nuevaVentana ) {
    nuevaVentana.focus();
  }
}


    function soloLetras(e) {
      key = e.keyCode || e.which;
      tecla = String.fromCharCode(key).toString();
              letras = " áéíóúabcdefghijklmnñopqrstuvwxyzÁÉÍÓÚABCDEFGHIJKLMNÑOPQRSTUVWXYZ";//Se define todo el abecedario 
                                                                                            //que se quiere que se muestre.
          especiales = [8, 37, 39, 46, 6]; //Es la validación del KeyCodes, que teclas recibe el campo de texto.

          tecla_especial = false
          for(var i in especiales) {
            if(key == especiales[i]) {
              tecla_especial = true;
              break;
            }
          }
          if(letras.indexOf(tecla) == -1 && !tecla_especial){
            sweetAlert("CAMPO SOLO ACEPTA LETRAS","VULVA A INTENTAR","error");                                        
            return false;
          }
        }

        function SoloNumeros(evt){
           if(window.event){//asignamos el valor de la tecla a keynum
            keynum = evt.keyCode; //IE
          }
          else{
            keynum = evt.which; //FF
          } 
           //comprobamos si se encuentra en el rango numérico y que teclas no recibirá.
           if((keynum > 47 && keynum < 58) || keynum == 8 || keynum == 13 || keynum == 6 ){
            return true;
          }
          else{
            sweetAlert("CAMPO SOLO ACEPTA NUMERO","VULVA A INTENTAR","error");  
            return false;
          }
        }


        function doSearch()
        {
          var tableReg = document.getElementById('datos');
          var searchText = document.getElementById('searchTerm').value.toLowerCase();
          var cellsOfRow="";
          var found=false;
          var compareWith="";

              // Recorremos todas las filas con contenido de la tabla
              for (var i = 1; i < tableReg.rows.length; i++)
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
