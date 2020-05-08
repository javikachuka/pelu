@extends('admin.index')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-auto">
                <h3>Detalles del Turno
                    <div class="badge badge-info">
                        {{$turno->id}}
                    </div>
                </h3>
            </div>
        </div>
    </div>
    <div class="card-body">
        {{$turno->id}}
    </div>

</div>
@endsection

