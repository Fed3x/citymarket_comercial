@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-end">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Departamentos</div>

                <div class="card-body">
                    <departamentos-component></departamentos-component>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
