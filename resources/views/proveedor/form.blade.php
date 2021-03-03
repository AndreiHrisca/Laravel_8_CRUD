<h1> {{ $modo }} proveedor</h1>

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
        <input type="text" class="form-control" name="Nombre" value="{{ isset($proveedor->Nombre)?$proveedor->Nombre:old('Nombre') }}" id="Nombre">
        
    </div>
    

    <div class="form-group">
        <label for="Correo">Correo</label>
        <input type="email" class="form-control" name="Correo" value="{{ isset($proveedor->Correo)?$proveedor->Correo:old('Correo') }}" id="Correo">
        
    </div>

    <div class="form-group">
        <label for="Foto"></label>
        @if(isset($proveedor->Foto))
        <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$proveedor->Foto }}" width="200px" alt="">
        @endif
        <input type="file" class="form-control" name="Foto" value="" id="Foto">
        
    </div>

    <input class="btn btn-success" type="submit" value="{{ $modo }} datos">

    <a href="{{ url('proveedor') }}" class="btn btn-primary">Regresar</a>