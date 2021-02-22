$(document).ready(function() {
    $('#example').DataTable( {
        "ajax": "data/objects.txt",
        "columns": [
            { "data": "Nombre" },
            { "data": "Apellido" },
            { "data": "Correo" },
            { "data": "Foto" }
        ]
    } );
} );