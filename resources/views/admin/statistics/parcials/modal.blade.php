<!-- MODAL STATISTICS -->
<div class="notificacion-text-fondo" id="modal-textoCorto" style="display: block">
    <div class="container-builder">
        <div class="builder-form-option">
            <div class="title-input-txt">
                <span id="icon-statistic-white"></span>
                <h2>Estadísticas</h2>
            </div>

            <div class="form-config-statistic">

                {!! Form::open(['route' => 'admin.statistics.index.columns', 'method' => 'POST', 'id' => 'form-columns']) !!}

                <div class="form-group"><label>COLECCIONES</label></div>
                    <div class="form-container">

                        <div class="form-group">
                            <label for="id">Selecciona una colección</label>
                            <select id="id" class="form-control" name="id">
                                @foreach( $collections as $collection )
                                    <option value="{{ $collection->id }}">{{ $collection->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <a id="get-columns" class="btn btn-primary">ENVIAR</a>
                        </div>
                    </div>
                {!! Form::close() !!}


                <div id="form-colums-div" style="display: none">
                    {!! Form::open(['route' => 'admin.statistics.index.columns.data', 'method' => 'POST', 'id' => 'form-columns-data']) !!}

                        <div class="form-group">
                            <label>COLUMNAS</label>
                        </div>

                        <div class="form-group">
                            <label for="num_colums">No. Columnas a gráficar</label>
                            {!! Form::select('num_colums', array(
                                '1' => '1 columna',
                                '2' => '2 o más columnas',
                            ), 'num_colums', ['id' => 'num_colums', 'class' => 'form-control']) !!}
                        </div>

                        <div class="form-group"><label>Seleccionar columnas</label></div>
                        <div id="list-colums" class="btn-group-vertical" data-toggle="buttons" style="width: 233px;"></div>

                        <div class="form-group">
                            <label for="group">Grupos de...</label>
                            {!! Form::number('gruop', 2, ['id'=> 'group', 'class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            <label for="frecuencia">Gráficar</label>
                            {!! Form::select('frecuencia', array(
                                'histograma' => 'Histograma',
                                'estadistico' => 'Estadisticos',
                                'grafico' => 'Graficos',
                                'porvar' => 'Por Variable',
                            ), 'frecuencia', ['id' => 'frecuencia', 'class' => 'form-control']) !!}
                        </div>
                        {!! Form::hidden('form', '123', ['id' => 'controlX']) !!}
                        <div class="form-group"><a id="get-data" class="btn btn-primary">GRÁFICAR</a></div>
                    {!! Form::close() !!}


                </div>

            </div>

            <div class="btn-input-txt-statistic">
                <p>* Limpia y genera una nueva estadística.</p>
                <button type="button" class="btn btn-primary" id="btn-limpiar">Limpiar</button>
                <button type="button" class="btn btn-danger" onclick="closeModalInputs('modal-textoCorto');">Cancelar</button>
            </div>

        </div>
        <div class="builder-form-preview">

            <h1 id="nav" class="text-center">Gráficas</h1>

            <div class="form-preview" id="div-data">
                @for( $i = -1; $i <= 100; $i++)
                    <div id="graph{{$i}}" class="graphX">
                        <div id="graphA{{$i}}" style="width: 100%; display: inline-block;"></div>
                        <canvas id="graphB{{$i}}"></canvas>
                        <div id="graphC{{$i}}" style="width: 100%; display: inline-block;"></div>
                    </div>
                @endfor
            </div>

            <style>
                #graph-1, #graph0 {display: none}
            </style>

        </div>
    </div>
</div>