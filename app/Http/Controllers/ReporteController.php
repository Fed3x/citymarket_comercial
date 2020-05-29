<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trabajo;
use Auth;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_departamento =  auth()->user()->perfil->id_departamento;

        $trabajos = Trabajo::whereHas('departamentos', function($q) use($id_departamento) {
            $q->where('departamentos.id', $id_departamento);
        })->get();
        return $trabajos;
        
    }
}
