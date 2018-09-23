
<div class="modal modal-danger fade" id="ModalEliminar-{{$user->id}}">
    <div class="modal-dialog modal-lg"> 

        <div class="modal-content"> 
            <div class="modal-header">
         
                <h4 class="modal-title"><i class="glyphicon glyphicon-warning-sign"></i> En este momento, se está eliminando la informacion.</h4>
            </div>

            <div class="modal-body">
                <p> Eliminando el resgistro del sistema.</p>
                <br>
                <p> Desea continuar con la acción solicitada?</p>
            </div>

            <div class="modal-footer ">
                <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Cancelar</button>
               
                {!! Form::button('Aceptar', ['type' => 'submit', 'class' => 'btn btn-outline']) !!}
            </div>

        </div> 

    </div>

</div> 
