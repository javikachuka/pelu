@extends('admin.index')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-auto">
                <h3>Fotos</h3>
            </div>
        </div>
    </div>
    <form class="form-group " method="POST" enctype="multipart/form-data" action="{{route("turnos.saveFotos")}}">
        <div class="card-body">
            <div class="form-group" id="fotitos">
                <label for="">Foto del trabajo finalizado</label>
                <div class="row">
                    <div class="col-md-4" id="otro0">
                        <div id="preview0" class="rounded float-left">
                        </div>
                        <input class="custom-file" id="imagenTrabajo0" type="file" name="fotos[]" accept="image/*"
                            capture="camera" style="" required />
                    </div>
                    <div class="btn-group-vertical">
                        <button type="button" id="agregar" class="btn btn-secondary">Agregar <i class="fal fa-plus"></i></button>
                    </div>
                </div>

            </div>
            <div class="form-group">
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-sm btn-success">Guardar</button>
        </div>
    @csrf
    </form>
</div>
@endsection

@push('scripts')
<script>
    var indice = 0 ;
    console.log(indice);
    //cargar imagen local de forma dinamica
    document.getElementById("imagenTrabajo"+indice).onchange = function(e) {
            // Creamos el objeto de la clase FileReader
            let reader = new FileReader();

            // Leemos el archivo subido y se lo pasamos a nuestro fileReader
            reader.readAsDataURL(e.target.files[0]);

            // Le decimos que cuando este listo ejecute el código interno
            reader.onload = function(){
                let preview = document.getElementById('preview'+indice) ;
                let otro = document.getElementById('otro') ;
                image = document.createElement('img');
                image.src = reader.result;
                image.height='240';
                image.width='320';
                preview.innerHTML = '';
                preview.append(image);
            };
    }

    $('#agregar').click(function(){
        indice += 1 ;
        var html = '' ;

        html =  '<div class="col-md-4" id="otro'+indice+'">'+
                '<div id="preview'+indice+'" class="rounded float-left">'+
                '</div>'+
               ' <input class="custom-file" id="imagenTrabajo'+indice+'" type="file" name="fotos[]" accept="image/*" capture="camera" style="" required />'+
               '</div>' ;
        var aux = indice-1 ;
        $('#otro'+aux+'').after(html) ;

        document.getElementById("imagenTrabajo"+indice).onchange = function(e) {
            // Creamos el objeto de la clase FileReader
            let reader = new FileReader();

            // Leemos el archivo subido y se lo pasamos a nuestro fileReader
            reader.readAsDataURL(e.target.files[0]);

            // Le decimos que cuando este listo ejecute el código interno
            reader.onload = function(){
                let preview = document.getElementById('preview'+indice),
                image = document.createElement('img');
                image.src = reader.result;
                image.height='240';
                image.width='320';
                preview.innerHTML = '';
                preview.append(image);
            };
    }
    }) ;
</script>
@endpush
