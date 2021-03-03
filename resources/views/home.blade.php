@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Lista de Cruds') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    {{ __('Estás logueado!') }}
                </div>

                <div class="card-body">
                    <ul>
                        <li><a href="./cliente">Clientes</a></li>
                        <li><a href="./empleado">Empleados</a></li>
                        <li><a href="./proveedor">Proveedores</a></li>
                    </ul>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection
