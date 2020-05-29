@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-end">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Departamentos</div>

                <div class="card-body">
                    <departamentos-component></departamentos-component>
                </div>
            </div>
        </div>
        <div class="col-md-2">
          <div class="card">
              <div class="card-header">Filtros</div>
                 {{-- <filters-component></filters-component> --}}
              <div class="card-body">
              </div>
          </div>
        </div>
    </div>
</div>
@endsection
