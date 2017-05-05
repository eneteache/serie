<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <title>Inicio</title>
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <!--<link rel="stylesheet" href="css/bootstrap-completo.css">-->
    <link rel="stylesheet" href="../css/index.css">

  <script src='../js/jquery.min.js'></script>
  <script src="../js/bootstrap.js"></script>
    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1, maximum-scale=1, minimum-scale=0.65">
    <script>
      <script>
        (function($){
          $(document).ready(function(){
            $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
              event.preventDefault();
              event.stopPropagation();
              $(this).parent().siblings().removeClass('open');
              $(this).parent().toggleClass('open');
            });
          });
        })
    </script>
</head>
<body>
  <div class="contenedor">
    <div class="form">
      <ul class="tab-group">

        <li class="tab active"><a href="#login">Iniciar sesión</a></li>
        <li class="tab "><a href="#signup">Crear cuenta</a></li>
        
      </ul>
          <div class="tab-content">
            
            <div id="login">

              <h2>¡Bienvenido de nuevo! :)</h2>
              <form method="post" onsubmit="return false" action= "return false" id="form">                 
                <div class="field-wrap">
                  <label>
                  Usuario<span class="req">*</span>
                  </label>
                  <input type="text"required autocomplete="off" name="usuario" id="usuario" />
                </div>
              
                <div class="field-wrap">
                  <label>
                  Contraseña<span class="req">*</span>
                  </label>
                  <input type="password"required autocomplete="off"/ name="clave" id="clave">
                </div>
                
                <p class="forgot"><a href="#">He olvidado mi contraseña</a></p>

                <div id= "error" style="margin: -5px 0 10px 0; color: #ff374a; font-weight: bold;"></div>
                <input class="button button-block" type= "submit" value="Iniciar sesión" onclick=" validarLogin(document.getElementById('usuario').value, document.getElementById('clave').value);">
                  
              </form>
            </div>
            <div id="signup">
              <h2>Rellena el formulario de registro</h2>
                
              <form action="../registro.php" method="post">
              <!--  
                <div class="top-row">
                  <div class="field-wrap">
                    <label>
                      First Name<span class="req">*</span>
                    </label>
                    <input type="text" required autocomplete="off"/>
                  </div>
                  
                    <div class="field-wrap">
                    <label>
                      Last Name<span class="req">*</span>
                    </label>
                    <input type="text"required autocomplete="off"/>
                    </div>
                </div>
              -->
                <div class="field-wrap">
                  <label>
                  Usuario<span class="req">*</span>
                  </label>
                  <input type="text" autocomplete="off" name="usuario" />
                </div>
                
                <div class="field-wrap">
                  <label>
                  Código de invitación<span class="req">*</span>
                  </label>
                  <input type="text" autocomplete="off" name="codigo" />
                </div>

                <div class="field-wrap">
                  <label>
                  Correo electrónico<span class="req">*</span>
                  </label>
                  <input type="email" autocomplete="off"/ name="correo">
                </div>
              
                <div class="field-wrap">
                  <label>
                  Contraseña<span class="req">*</span>
                  </label>
                  <input type="password" autocomplete="off" name="clave" />
                </div>

                <div class="field-wrap">
                  <label>
                  Repetir contraseña<span class="req">*</span>
                  </label>
                  <input type="password"required autocomplete="off" name="clave2" />
                </div>
              
                <button type="submit" class="button button-block"/>Crear cuenta</button>
              </form>
            </div>
          
          </div> <!-- tab-content -->
      </div> <!-- /form -->

      <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
      <script src="../js/index.js"></script>
      <script>
      function formReset(){
      document.getElementById("form").reset();
      }

      function validarLogin(usuario, clave)
            {
                $.ajax({
                    url: "validarInicio.php",
                    type: "POST",
                    data: "usuario="+usuario+"&clave="+clave,
                    success: function(resp){
                    $('#error').html(resp)
                    $("input[type='password']").val('');
                    }       
                });
            }  
        </script>      
    </div>
</body>
</html>