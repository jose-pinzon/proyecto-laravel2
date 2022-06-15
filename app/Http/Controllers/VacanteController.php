<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Experiencia;
use App\Salario;
use App\Ubicacion;
use App\Vacante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class VacanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $vacantes = auth()->user()->vacantes()->latest()->simplePaginate(10);//simplePaginate, este muestra la paginacion sin clases

        return view('Vacantes.index',compact('vacantes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::all();
        $Experiencias = Experiencia::all();
        $ubicacion = Ubicacion::all();
        $salarios = Salario::all();

        return view('Vacantes.create')
                ->with('categorias',$categorias)
                ->with('Experiencias',$Experiencias)
                ->with('salarios',$salarios)
                ->with('ubicacion',$ubicacion);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'required|min:8',
            'categoria' => 'required',
            'ubicacion' => 'required',
            'experiencia' => 'required',
            'salario' => 'required',
            'description' => 'required|min:50',
            'imagen' => 'required',
            'habilidad'=>'required'
        ]);

        auth()->user()->vacantes()->create([
            'titulo' => $data['titulo'],
            'categoria_id'=>$data['categoria'],
            'experiencia_id'=>$data['experiencia'],
            'ubicacion_id'=>$data['ubicacion'],
            'salario_id'=>$data['salario'],
            'descripcion' => $data['description'],
            'imagen'=>$data['imagen'],
            'habilidad'=>$data['habilidad'],
        ]);

        return redirect()->route('vacantes.index')->with(['status','Se agrego correctamente la vacante']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function show(Vacante $vacante)
    {

        // if($vacante->activa === 0 ) return abort(404);

        return view('Vacantes.show', compact('vacante'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function edit(Vacante $vacante)
    {
        $this->authorize('view',$vacante);
        $categorias = Categoria::all();
        $Experiencias = Experiencia::all();
        $ubicacion = Ubicacion::all();
        $salarios = Salario::all();
        return view('Vacantes.edit',compact('vacante','categorias','Experiencias','ubicacion','salarios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vacante $vacante)
    {
        $this->authorize('update',$vacante);


        $data = $request->validate([
            'titulo' => 'required|min:8',
            'categoria' => 'required',
            'ubicacion' => 'required',
            'experiencia' => 'required',
            'salario' => 'required',
            'description' => 'required|min:50',
            'imagen' => 'required',
            'habilidad'=>'required'
        ]);

        $vacante->titulo = $data['titulo'];
        $vacante->categoria_id = $data['categoria'];
        $vacante->experiencia_id = $data['experiencia'];
        $vacante->ubicacion_id = $data['ubicacion'];
        $vacante->salario_id = $data[ 'salario'];
        $vacante->descripcion = $data['description'];
        $vacante->imagen =  $data['imagen'];
        $vacante->habilidad = $data['habilidad'];

        $vacante->save();

            return redirect()-> route('vacantes.index')->with(['status','Se actualizo correctamente '.$vacante->titulo]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vacante $vacante)
    {

        $this->authorize('delete',$vacante);

        $vacante->delete();

        return Response()->json(['mensaje' => 'Eliminado vacante ' .$vacante->titulo]);
    }


    public function imagen(Request $request)
    {
        $imagen = $request->file('file');
        $nombreImagen = time() . '.'.$imagen->extension();
        $imagen->move(public_path('storage/vacantes'),$nombreImagen);
        return response()->json(['correcto' => $nombreImagen]);
    }
    public function borrarImagen(Request $request)
    {
        if($request->ajax()){

            $imagen = $request->get('imagen');

            //ESTE file es un metodo de laravel para saber si existe archivo
            if( File::exists( 'storage/vacantes/'.$imagen )){
                File::delete('storage/vacantes/'.$imagen);
            }

            return response('Imagen Eliminada', 200);
        }
    }

    public function cambiarEstado(Request $request,Vacante $vacante){

        //Leer nuevo estado
        $vacante->activa = $request->estado;

        //Guardarlo en la base de datos
        $vacante->save();


        return response()->json(['res' => 'Correcto']);
    }


    public function buscar(Request $request){

        $data = $request->validate([
            'categoria' => 'required',
            'ubicacion' => 'required'
        ]);

        $categoria = $data['categoria'];
        $ubicacion = $data['ubicacion'];

        $vacantes = Vacante::latest()->where('categoria_id',$categoria)->Where('ubicacion_id',$ubicacion)->get(); //!orWhere son para traer los anteriores where o de este

        return view('buscar.index',compact('vacantes'));

    }

    public function resultados(){

    }




}
