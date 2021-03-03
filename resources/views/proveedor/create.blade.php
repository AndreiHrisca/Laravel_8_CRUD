@extends('layouts.app')
@section('content')
<div class="container">

    <form action="{{ url('/proveedor') }}" method="post" enctype="multipart/form-data">
        @csrf <!-- Llave de seguridad para validar el formulario. -->
        @include('proveedor.form',['modo'=>'Guardar'])
    </form>

</div>
@endsection