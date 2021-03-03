@extends('layouts.app')
@section('content')
<div class="container">

    <form action="{{ url('/proveedor/'.$proveedor->id ) }}" method="post" class="basic-form" enctype="multipart/form-data">
        @csrf
        {{ method_field('PATCH') }}
        @include('proveedor.form',['modo'=>'Editar'])
    </form>

</div>
@endsection