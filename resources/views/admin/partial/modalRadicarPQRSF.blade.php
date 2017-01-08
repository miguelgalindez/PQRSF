<!-- Modal -->
    <div id="modalRadicar" class="modal fade" role="dialog">
        <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">X</button>
            <h4 class="modal-title">Radicar PQRSF</h4>
          </div>
            <div class="modal-body">    
                <form class="form-horizontal" id="formularioRadicarPQRSF">

                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <input type="hidden" name="mRadCodigoPQRSF" value="" id="mRadCodigoPQRSF">
                    
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="idRadicado">Número del radicado</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="idRadicado" name="idRadicado">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4" for="fechaRadicado">Fecha del radicado</label> 
                        <div class="col-sm-8">
                            <input type='text' class="form-control" id="fechaRadicado" name="fechaRadicado" />
                        </div>
                    </div>                                    
                    
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="fechaVencimientoPQRSF">Vencimiento de la PQRSF</label> 
                        <div class="col-sm-8">
                            <input type='text' class="form-control" id="fechaVencimientoPQRSF" name="fechaVencimientoPQRSF" />
                        </div>
                    </div>


                </form>
          </div>
          <div class="modal-footer">
            <div class="col-lg-offset-4">
                <a class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</a>
                <a id="btnModalRadicar" class="btn btn-success pull-right">Radicar</a>            
            </div>            
          </div>
        </div>

        </div>
    </div>