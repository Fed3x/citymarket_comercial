@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-end">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">Asignacion de Departamentos por Trabajos</div>

                <div class="card-body">
                    <departamentos-trabajos-component></departamentos-trabajos-component>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
