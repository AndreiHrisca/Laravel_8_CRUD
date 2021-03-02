<h1> {{ $modo }} cliente</h1>

    @if(count($errors)>0)
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach( $errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-group">
        <label for="Nombre">Nombre</label>
        <input type="text" class="form-control" name="Nombre" value="{{ isset($cliente->Nombre)?$cliente->Nombre:old('Nombre') }}" id="Nombre">
        
    </div>
    
    <div class="form-group">
        <label for="Apellido">Apellido</label>
        <input type="text" class="form-control" name="Apellido" value="{{ isset($cliente->Apellido)?$cliente->Apellido:old('Apellido') }}" id="Apellido">
        
    </div>

    <div class="form-group">
        <label for="Dni">Dni</label>
        <input type="text" class="form-control" name="Dni" value="{{ isset($cliente->Dni)?$cliente->Dni:old('Dni') }}" id="Dni">
        
    </div>

    <div class="form-group">
        <label for="Correo">Correo</label>
        <input type="email" class="form-control" name="Correo" value="{{ isset($cliente->Correo)?$cliente->Correo:old('Correo') }}" id="Correo">
        
    </div>

    <div class="form-group">
        <label for="Foto"></label>
        @if(isset($cliente->Foto))
        <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$cliente->Foto }}" width="200px" alt="">
        @endif
        <input type="file" class="form-control" name="Foto" value="" id="Foto">
        
    </div>

    <input class="btn btn-success" type="submit" value="{{ $modo }} datos">

    <a href="{{ url('cliente') }}" class="btn btn-primary">Regresar</a>