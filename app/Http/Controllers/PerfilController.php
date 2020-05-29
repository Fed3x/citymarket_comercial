<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Perfil;
use Carbon\Carbon;
use Auth;


class PerfilController extends Controller
{
    public function index()
    {
        $perfiles = Perfil::with('departamento')->orderBy('created_at','asc')->paginate(15);
        return $perfiles;
    }

    public function store(Request $request)
    {
        $perfil = New Perfil();
        $perfil->descripcion = $request->descripcion;
        $perfil->id_departamento = $request->id_departamento;
        $perfil->estado = true;
        $perfil->created_by =  Auth::user()->name;
        $perfil->created_at = Carbon::now();
        $perfil->save();
        $perfil->load('departamento');
        
        return $perfil;
    }
    public function update(Request $request, $id)
    {
        $perfil = Perfil::find($id);
        $perfil->descripcion = $request->descripcion;
        $perfil->id_departamento = $request->id_departamento;
        $perfil->estado = $request->estado;
        $perfil->updated_by =  Auth::user()->name;
        $perfil->updated_at = Carbon::now();
        $perfil->save();
        $perfil->load('departamento');

        return ['perfil' => $perfil, 'index' => $request->index ];
    }

    public function destroy($id)
    {
        $perfil = Perfil::find($id);
        $perfil->delete();
    }
}
