<?php

namespace App\Http\Controllers;

use App\Candidato;
use Illuminate\Http\Request;
use App\Notifications\NuevoCandidato;
use App\Vacante;

class CandidatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( $id )
    {
        //?obtener id actual
        // $id_vacante = $request->route('id');

        // // ?Obtener los candidatos y la vacante
        $vacante = Vacante::findOrFail($id);
        $this->authorize('view',$vacante);
        return view('Candidatos.index',compact('vacante'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'nombre' => 'required',
            'email' => 'required|email',
            // 'cv' => 'required|mimes:pdf|max:1000',
            'vacante_id' => 'required'
        ]);

        if ($request->file('cv')) {
            $archivo = $request->file('cv');
            $nombreArchivo = time(). "." . $request->file('cv')->extension();
            $ubicacion = public_path('/storage/cv');
            $archivo->move($ubicacion, $nombreArchivo);
        }

        $candidato = new Candidato($data);
        $candidato-> cv = $nombreArchivo;
        $candidato->save();

        $vacante= Vacante::find($data['vacante_id']);
        // !Enviar notificacion
        $reclutador = $vacante->reclutador;
        $reclutador->notify( new NuevoCandidato($vacante->titulo, $vacante->id) );


        return back()->with('status','Dato enviado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function show(Candidato $candidato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function edit(Candidato $candidato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Candidato $candidato)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function destroy(Candidato $candidato)
    {
        //
    }
}
