@extends('admin.index')
@section('content')

<div class="card mb-3" style="height:10rem">
    <img src="https://www.infobae.com/new-resizer/lipp0snBZvPrNf56VPHClzbLZp0=/750x0/filters:quality(100)/s3.amazonaws.com/arc-wordpress-client-uploads/infobae-wp/wp-content/uploads/2018/04/21143647/Barbas.jpg"
        class="img-fluid" alt="Responsive image">
    {{-- <img  src="https://www.infobae.com/new-resizer/lipp0snBZvPrNf56VPHClzbLZp0=/750x0/filters:quality(100)/s3.amazonaws.com/arc-wordpress-client-uploads/infobae-wp/wp-content/uploads/2018/04/21143647/Barbas.jpg"
        class="card-img-top" alt="..."> --}}
    <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content.
            This content is a little bit longer.</p>
        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-auto">
                <h3>Inicio</h3>
            </div>
            <div class="col-md-auto">
                <button type="button" class="btn btn-sm btn-secondary"
                    onclick="location.href='{{ route('horarios.create')}}'"><i class="fas fa-plus"></i></button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <p>Descripcion de empresa</p>

        <h3>Servicios disponibles:</h3>
        <div class="card-deck">
            <div class="card">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                        additional content. This content is a little bit longer.</p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Last updated 3 mins ago</small>
                </div>
            </div>
            <div class="card">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This card has supporting text below as a natural lead-in to additional content.
                    </p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Last updated 3 mins ago</small>
                </div>
            </div>
            <div class="card">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                        additional content. This card has even longer content than the first to show that equal height
                        action.</p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Last updated 3 mins ago</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection