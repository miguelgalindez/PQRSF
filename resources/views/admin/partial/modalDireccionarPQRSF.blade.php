<!-- Modal -->
    <div id="modalDireccionar" class="modal fade" role="dialog">
        <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">X</button>
            <h4 class="modal-title">Direccionar solicitud</h4>
          </div>
            <div class="modal-body">    
                <form class="form-horizontal" id="formularioDireccionarPQRSF">

                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <input type="hidden" name="codigoPQRSF" value="" id="codigoPQRSF">
                    <input type="hidden" name="idPersona" value="" id="idPersona">
                    <input type="hidden" name="asunto" value="" id="asunto">
                    <input type="hidden" name="descripcion" value="" id="descripcion">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="dependencia">Dependencia</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="dependencia" name="dependencia"></select>         
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="funcionario">Funcionario</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="funcionario" name="funcionario"></select>         
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="fechaVencimiento">Fecha de vencimiento</label> 
                        <div class="col-sm-10">
                            <input type='text' class="form-control" id="fechaVencimiento" name="fechaVencimiento" />                        
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="prioridad">Prioridad</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="prioridad" name="prioridad"></select>           
                        </div>
                    </div>                
                </form>
          </div>
          <div class="modal-footer">
            <div class="col-lg-offset-2">
                <a class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</a>
                <a id="btnModalDireccionar" class="btn btn-success pull-right">Direccionar</a>            
            </div>            
          </div>
        </div>

        </div>
    </div>