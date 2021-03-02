@extends('layouts.app')

@section('content')
<div class="container">


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

    


<a href="{{ url('cliente/create') }}" class="btn btn-success" >Registrar nuevo cliente</a>
<br>
<br>

<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>Id</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Dni</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach( $clientes as $cliente)
        <tr>
            <td>{{ $cliente->id}}</td>
            <td><img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$cliente->Foto }}" width="100px" alt=""></td>
            <td>{{ $cliente->Nombre}}</td>
            <td>{{ $cliente->Apellido}}</td>
            <td>{{ $cliente->Dni}}</td>
            <td>{{ $cliente->Correo}}</td>
            
            <td>
            <a href="{{ url('/cliente/' . $cliente->id . '/edit') }}" class="btn btn-warrning">Editar</a>
             
            <form action="{{ url('/cliente/'.$cliente->id ) }}" class="d-inline" method="post">
                @csrf
                {{ method_field('DELETE') }}
                <input type="submit" class="btn btn-danger" onclick="return confirm('¿Estas seguro de borrar?')" value="Borrar">
            </form>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{!! $clientes->links() !!}
</div>
@endsection



<script>
    $(document).ready(function() {
    $('#clientes').DataTable( {
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