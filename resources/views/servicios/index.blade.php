@extends('admin.index')


@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-auto">
                <h3>Servicios Creados</h3>
            </div>
            <div class="col-md-auto">
                <button type="button" class="btn btn-sm btn-secondary"
                    onclick="location.href='{{ route('servicios.create')}}'"><i class="fas fa-plus"></i></button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-responsive table-bordered table-striped table-hover dataTable">
            <thead class="thead-dark">
                <tr>
                    <th width="10%">#</th>
                    <th width="25%">Servicio</th>
                    <th width="20%">Duracion (Horas:Minutos:Segundos)</th>
                    <th width="10%">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @if (!$servicios->isEmpty())
                @foreach ($servicios as $servicio)
                <tr>
                    <td>{{$servicio->id}}</td>
                    <td>{{$servicio->servicio}}</td>
                    <td>{{$servicio->duracion}} </td>
                    <td class="d-flex justify-content-center ">
                        <a class="p-1 text-primary"><i class="fal fa-edit"></i></a>
                        <a class="p-1 text-danger delete" val-servicio="{{$servicio->id}}"><i
                                class="fal fa-trash-alt"></i></a>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@include('modals.confirmDelete')
@endsection
@push('scripts')
<script>
    $(document).on('click', '.delete', function(){
    id = $(this).attr('val-servicio');
    url2="{{route('servicios.delete',":id")}}";
    url2=url2.replace(':id',id);

    $('#formDelete').attr('action',url2);
    $('#confirmDelete').modal('show');
    });

    $('#formDelete').on('submit',function(){
    $('#ok_delete').text('Eliminando...')
    });
</script>
@endpush