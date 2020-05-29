<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trabajo;
use Carbon\Carbon;
use Auth;

class TrabajoController extends Controller
{
    public function index()
    {
        $trabajos = Trabajo::orderBy('created_at','asc')->paginate(15);
        return $trabajos;
    }

    public function store(Request $request)
    {
        $trabajo = New trabajo();
        $trabajo->descripcion = $request->descripcion;
        $trabajo->area_trabajo = $request->area_trabajo;
        $trabajo->trabajo = $request->trabajo;
        $trabajo->estado = true;
        $trabajo->created_by =  Auth::user()->name;
        $trabajo->created_at = Carbon::now();
        $trabajo->save();
        
        return $trabajo;
    }
    public function update(Request $request, $id)
    {
        $trabajo = trabajo::find($id);
        $trabajo->descripcion = $request->descripcion;
        $trabajo->area_trabajo = $request->area_trabajo;
        $trabajo->trabajo = $request->trabajo;
        $trabajo->estado = $request->estado;
        $trabajo->updated_by =  Auth::user()->name;
        $trabajo->updated_at = Carbon::now();
        $trabajo->save();

        return ['trabajo' => $trabajo, 'index' => $request->index ];
    }

    public function destroy($id)
    {
        $trabajo = trabajo::find($id);
        $trabajo->delete();
    }
}
