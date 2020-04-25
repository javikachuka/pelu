@extends('raiz')

@section('content')
<div class="container">
    <p>asdfasdf</p>
    <div id="datepicker" data-date="12/03/2012"></div>
    <input type="hidden" id="my_hidden_input">
</div>
@endsection
@push('scripts')
<script>
    $('#datepicker').datepicker({
            language: 'es'
    });
    $('#datepicker').on('changeDate', function() {
        $('#my_hidden_input').val(
            $('#datepicker').datepicker('getFormattedDate')
        );
    });
</script>

@endpush


