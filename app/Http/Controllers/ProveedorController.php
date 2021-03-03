<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['proveedores']=Proveedor::paginate(5);
        return view('proveedor.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('proveedor.create');
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
            'Correo'=>'required|email',
            'Foto'=>'required|max:1000|mimes:jpeg,png,jpg',
        ];
        $mensaje=[
            'required'=>'El :attribute es requerido.',
            'Foto.required'=>'La foto es requerida.'
        ];
        $this->validate($request, $campos, $mensaje);



        $datosProveedor = request()->except('_token');

        if($request->hasFile('Foto')){
            $datosProveedor['Foto']=$request->file('Foto')->store('uploads','public'); /* Guarda la foto en la carpeta uploads. */
        }
        Proveedor::insert($datosProveedor);

        return response()->json($datosProveedor);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function show(Proveedor $proveedor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proveedor=Proveedor::findOrFail($id);
        return view('proveedor.edit', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Validar campos.
        $campos=[
            'Nombre'=>'required|string|max:100',
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
        $datosProveedor = request()->except(['_token','_method']);

        if($request->hasFile('Foto')){
            $proveedor = Proveedor::findOrFail($id);
            Storage::delete('public/'.$proveedor->Foto);
            $datosProveedor['Foto']=$request->file('Foto')->store('uploads','public');
        }

        Proveedor::where('id','=',$id)->update($datosProveedor);

        $proveedor = Proveedor::findOrFail($id);
        
        
        return redirect('proveedor')->with('mensaje','proveedor modificado.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proveedor = Proveedor::findOrFail($id);

        if(Storage::delete('public/'.$proveedor->Foto)){
            
            Proveedor::destroy($id);

        }

        
        return redirect('proveedor')->with('mensaje','Proveedor borrado.');
    }
}
