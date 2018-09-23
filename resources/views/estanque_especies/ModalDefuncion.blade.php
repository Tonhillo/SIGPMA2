<!-- Modal para el texto de eliminar -->
<div class="modal fade in" id="ModalDefuncion-{{$estanqueEspecie->id}}">
    <div class="modal-dialog"> <!-- Inicio del div del MODAL-DIALOG -->

        <div class="modal-content"> <!-- Inicio del div del MODAL-CONTENT -->

            <!-- Declaracion del encabezado -->
            <div class="modal-header">
                <h4 class="modal-title">Defuncón Especie <i class="glyphicon glyphicon-share-alt"></i></h4>
                <h5>Especie: {{$estanqueEspecie->especie->nombre_comun}} </h5>
            </div>

            <!-- Declaracion del cuerpo del modal -->
            <div class="modal-body">
                <div class="form-group">

                    {{--fecha evento--}}
                    {!! Form::label('fecha', 'Fecha del evento:') !!}
                    <div class="bfh-datepicker" data-name="fecha" data-format  ="y-m-d" data-max="today"></div>

                    {{--Motivo del traslado--}}
                    <label>Describa el motivo de defunción</label>
                    <input type="textarea" name="motivo" class="form-control"/>

                    {{--cantidad--}}
                    {!! Form::label('cantidad', 'Seleccione La Cantidad De Individuos:') !!}
                    <input type="number" step="any" min="1" max="{{$estanqueEspecie->cantidad}}" step="1" name="cantidad" class="form-control"/>

                </div>
                <div class="form-group">


            </div>

            <!-- Declaracion del pie del modal -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                {!! Form::button('Aceptar', ['type' => 'submit', 'class' => 'btn btn-info']) !!}
            </div>

            </div> <!-- Cierre del div MODAL-DIALOG -->

        </div><!-- Cierre del div del MODAL-CONTENT -->

    </div> <!-- Cierre del div MODAL-DIALOG -->

</div> <!-- Cierre del div del modal -->