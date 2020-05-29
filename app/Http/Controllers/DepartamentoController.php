<?php

namespace App\Http\Controllers;

use App\Departamento;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

class DepartamentoController extends Controller
{
    public function index()
    {
        $departamentos = Departamento::orderBy('created_at','asc')->paginate(15);
        return $departamentos;
    }

    public function store(Request $request)
    {
        $departamento = New Departamento();
        $departamento->descripcion = $request->descripcion;
        $departamento->abreviatura = $request->abreviatura;
        $departamento->estado = true;
        $departamento->created_by =  Auth::user()->name;
        $departamento->created_at = Carbon::now();
        $departamento->save();
        
        return $departamento;
    }
    public function update(Request $request, $id)
    {
        $departamento = Departamento::find($id);
        $departamento->descripcion = $request->descripcion;
        $departamento->abreviatura = $request->abreviatura;
        $departamento->estado = $request->estado;
        $departamento->updated_by =  Auth::user()->name;
        $departamento->updated_at = Carbon::now();
        $departamento->save();

        return ['departamento' => $departamento, 'index' => $request->index ];
    }

    public function destroy($id)
    {
        $departamento = Departamento::find($id);
        $departamento->delete();
    }
}
