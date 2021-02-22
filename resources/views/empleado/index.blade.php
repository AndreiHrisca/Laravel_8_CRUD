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

    


<a href="{{ url('empleado/create') }}" class="btn btn-success" >Registrar nuevo empleado</a>
<br>
<br>

<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>Id</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach( $empleados as $empleado)
        <tr>
            <td>{{ $empleado->id}}</td>
            
            <td>
            <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$empleado->Foto }}" width="100px" alt="">
            </td>
            
            <td>{{ $empleado->Nombre}}</td>
            <td>{{ $empleado->Apellido}}</td>
            <td>{{ $empleado->Correo}}</td>
            
            <td>
            <a href="{{ url('/empleado/' . $empleado->id . '/edit') }}" class="btn btn-warrning">Editar</a>
             
            
            <form action="{{ url('/empleado/'.$empleado->id ) }}" class="d-inline" method="post">
                @csrf
                {{ method_field('DELETE') }}
                <input type="submit" class="btn btn-danger" onclick="return confirm('¿Estas seguro que quieres borrar?')" value="Borrar">
            </form>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{!! $empleados->links() !!}
</div>
@endsection
<script>
    $(document).ready(function() {
    $('#empleados').DataTable( {
        "serverSide": true,
        "ajax": "{{ url('api/users') }}"
        "columns": [
            { data: "Nombre" },
            { data: "Apellido" },
            { data: "Correo" },
            { data: "Foto" }
        ]
    } );
} );
</script>