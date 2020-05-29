<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Mail;
use App\Mail\NuevoUsuarioNotificacion;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Auth;
use Carbon\Carbon;

class UsuarioController extends Controller
{

    public function index()
    {
        $usuarios = User::with('perfil')->orderBy('created_at')->paginate(15);
        return $usuarios;
    }
    public function store(Request $request)
    {
        $digits_needed=8;
        $random_number='';
        $count=0;
        while ( $count < $digits_needed ) {
            $random_digit = mt_rand(0, 9);
            
            $random_number .= $random_digit;
            $count++;
        }

        $usuario = New User();
        $usuario->name = $request->usuario;
        $usuario->email = $request->email;
        $usuario->id_perfil = $request->id_perfil;
        $usuario->estado = true;
        $usuario->password = Hash::make($random_number);
        $usuario->created_by =  Auth::user()->name;
        $usuario->created_at = Carbon::now();
        $usuario->save();
        $usuario->load('perfil');

        Mail::to($request->email)->send(new NuevoUsuarioNotificacion($request->usuario, $random_number, $request->email));
        
        return $usuario;
    }

    public function update(Request $request, $id)
    {
        $usuario = User::find($id);
        $usuario->name = $request->usuario;
        $usuario->email = $request->email;
        $usuario->id_perfil = $request->id_perfil;
        $usuario->estado = $request->estado;
        $usuario->updated_by =  Auth::user()->name;
        $usuario->updated_at = Carbon::now();
        $usuario->save();
        $usuario->load('perfil');

        return ['usuario' => $usuario, 'index' => $request->index ];
    }

    public function destroy($id)
    {
        $perfil = User::find($id);
        $perfil->delete();
    }
}
