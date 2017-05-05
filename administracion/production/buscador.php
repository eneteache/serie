<?php 
function tipo(){

  if (isset($_SESSION['tipoEntrada'])){
    return $_SESSION['tipoEntrada'];
  }

}
?>
                    <form id="form1" data-parsley-validate class="form-horizontal form-label-left" method="POST">
                      <input type="hidden" value="<?php echo tipo(); ?>" id="tipo">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id">Buscar por ID <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="id" required name="id" class="form-control col-md-7 col-xs-12">
                        </div>

                      </div>
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button class="btn btn-primary" type="reset">Resetear</button>
                          <input onclick="recuperar(); " type="button" name="boton-enviar" id="boton-enviar" class="btn btn-success" value="Buscar">
                          
                        </div>
                      </div>          
                    </form>