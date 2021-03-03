@extends('layouts.app')
@section('content')
<div class="container">

    <form action="{{ url('/cliente') }}" method="post" id="basic-form" enctype="multipart/form-data">
        @csrf <!-- Llave de seguridad para validar el formulario. -->
        @include('cliente.form',['modo'=>'Guardar'])
    </form>

</div>
@endsection