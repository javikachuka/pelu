@extends('admin.index')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-auto">
                <h3>Fotos</h3>
                <ul>
                    <li>Puede cargar hasta un máximo de tres fotos</li>
                    <li>Al menos una foto es requerida</li>
                    <li>Pidale al cliente que sonria <i class="fal fa-smile-beam"></i></li>
                </ul>
            </div>
        </div>
    </div>
    <form class="form-group " method="POST" enctype="multipart/form-data" action="{{route("turnos.saveFotos")}}">
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th colspan="2">
                            Cliente: {{$turno->usuario->name}} {{$turno->usuario->apellido}}
                        </th>
                    </tr>
                    <input type="hidden" value="{{$turno->id}}" name="turno_id">
                </thead>
                <tbody>
                    <tr>
                        <td width="40%">
                            <input type="file" class="filestyle" data-text="Foto" onchange="cargarFoto(1,event.target)" accept="image/*" name="fotos[]"
                                data-placeholder="Primer foto" required>
                        </td>
                        <td width="80%">
                            <div id="preview1" class="text-center">
                            </div>
                        </td>
                    <tr>
                        <td width="40%">
                            <input type="file" class="filestyle" data-text="Foto" onchange="cargarFoto(2,event.target)" accept="image/*" name="fotos[]"
                                data-placeholder="Segunda foto">
                        </td>
                        <td width="80%">
                            <div id="preview2" class="text-center">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="40%">
                            <input type="file" class="filestyle" data-text="Foto" onchange="cargarFoto(3, event.target)" accept="image/*" name="fotos[]"
                                data-placeholder="Tercer foto">
                        </td>
                        <td width="80%">
                            <div id="preview3" class="text-center" >
                            </div>
                        </td>
                    </tr>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="float-right mr-4">
            <a href="javascript:history.back()" class="btn btn-danger btn-sm">Cancelar</a>
            <button type="submit" class="btn btn-secondary btn-sm">Guardar</button>
        </div>
        @csrf
    </form>
</div>
@endsection

@push('scripts')

<script>
    function cargarFoto(n,target){
        // Creamos el objeto de la clase FileReader
        let reader = new FileReader();

        // Leemos el archivo subido y se lo pasamos a nuestro fileReader
        reader.readAsDataURL(target.files[0]);

        // Le decimos que cuando este listo ejecute el código interno
        reader.onload = function(){
            let preview = document.getElementById('preview'+n) ;
            image = document.createElement('img');
            image.src = reader.result;
            image.height='240';
            image.width='320';
            preview.innerHTML = '';
            preview.append(image);
        };
    }
</script>
@endpush
