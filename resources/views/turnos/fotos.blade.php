@extends('raiz')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-auto">
                <h3>Fotos</h3>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="form-group" id="fotitos">
            <label for="">Foto del trabajo finalizado</label>
            <div class="row justify-content-center">
                <div id="preview0">
                </div>

                <input class="custom-file" id="imagenTrabajo0" type="file" name="fotoFin[]" accept="image/*"
                    capture="camera" style="" required />
            </div>

        </div>
        <div class="form-group">
            <button type="button" id="agregar" class="btn btn-secondary btn-lg btn-block">agregar otra</button>
        </div>
    </div>
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
                let preview = document.getElementById('preview'+indice),
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

        html = '<div id="preview'+indice+'">'+
                '</div>'+
               ' <input class="custom-file" id="imagenTrabajo'+indice+'" type="file" name="fotoFin" accept="image/*" capture="camera" style="" required />' ;
        $('#fotitos').append(html) ;

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
