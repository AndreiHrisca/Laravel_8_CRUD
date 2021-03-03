@extends('layouts.app')

@section('content')
<div class="container">

    <h2>Lista proveedores</h2>
    
    @if(Session::has('mensaje'))
    <div class="alert alert-success alert-dismissible" role="alert">
    {{ Session::get('mensaje') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">
                &times;
            </span>
        </button>
    </div>
    @endif

    


<a href="{{ url('proveedor/create') }}" class="btn btn-success" >Registrar nuevo proveedor</a>
<br>
<br>

<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>Id</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach( $proveedores as $proveedor)
        <tr>
            <td>{{ $proveedor->id}}</td>
            <td><img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$proveedor->Foto }}" width="100px" alt=""></td>
            <td>{{ $proveedor->Nombre}}</td>
            <td>{{ $proveedor->Correo}}</td>
            
            <td>
            <a href="{{ url('/proveedor/' . $proveedor->id . '/edit') }}" class="btn btn-warning">Editar</a>
             
            <form action="{{ url('/proveedor/'.$proveedor->id ) }}" class="d-inline" method="post">
                @csrf
                {{ method_field('DELETE') }}
                <input type="submit" class="btn btn-danger" onclick="return confirm('¿Estas seguro de borrar?')" value="Borrar">
            </form>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{!! $proveedores->links() !!}
</div>
@endsection



<script>
    $(document).ready(function() {
    $('#proveedors').DataTable( {
        "serverSide": true,
        "ajax": "{{ url('api/users') }}"
        "columns": [
            { data: "Nombre" },
            { data: "Apellido" },
            { data: "Dni" },
            { data: "Correo" },
            { data: "Foto" }
        ]
    } );
} );
</script>