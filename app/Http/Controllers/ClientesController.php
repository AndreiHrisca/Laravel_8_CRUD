<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['clientes']=Clientes::paginate(5);
        return view('cliente.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         /**
         * Validar longitud de los campos parte back.
         */
        $campos=[
            'Nombre'=>'required|string|max:100',
            'Apellido'=>'required|string|max:150',
            'Dni'=>'required|string|max:9',
            'Correo'=>'required|email',
            'Foto'=>'required|max:1000|mimes:jpeg,png,jpg',
        ];
        $mensaje=[
            'required'=>'El :attribute es requerido.',
            'Foto.required'=>'La foto es requerida.'
        ];
        $this->validate($request, $campos, $mensaje);

        


        $datosCliente = request()->except('_token');

        if($request->hasFile('Foto')){
            $datosCliente['Foto']=$request->file('Foto')->store('uploads','public'); /* Guarda la foto en la carpeta uploads. */
        }
        Clientes::insert($datosCliente);

        return response()->json($datosCliente);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function show(Clientes $clientes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente=Clientes::findOrFail($id);
        return view('cliente.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Validar campos.
        $campos=[
            'Nombre'=>'required|string|max:100',
            'Apellido'=>'required|string|max:150',
            'Dni'=>'required|max:9',
            'Correo'=>'required|email',
        ];
        $mensaje=[
            'required'=>'El :attribute es requerido.',
        ];

        if($request->hasFile('Foto')){
            $campos=['Foto'=>'required|max:1000|mimes:jpeg,png,jpg'];
            $mensaje=['Foto.required'=>'La foto es requerida, debe ser JPEG, PNG, JPG.'];
        }
        $this->validate($request, $campos, $mensaje);



        //
        $datoscliente = request()->except(['_token','_method']);

        if($request->hasFile('Foto')){
            $cliente = Clientes::findOrFail($id);
            Storage::delete('public/'.$cliente->Foto);
            $datoscliente['Foto']=$request->file('Foto')->store('uploads','public');
        }

        Clientes::where('id','=',$id)->update($datoscliente);

        $cliente = Clientes::findOrFail($id);
        
        
        return redirect('cliente')->with('mensaje','cliente modificado.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = Clientes::findOrFail($id);

        if(Storage::delete('public/'.$cliente->Foto)){
            
            Clientes::destroy($id);

        }

        
        return redirect('cliente')->with('mensaje','Cliente borrado.');
    }
}
