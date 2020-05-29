@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-end">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Trabajos</div>

                <div class="card-body">
                    <trabajos-component></trabajos-component>
                </div>
            </div>
        </div>
        {{-- <div class="col-md-2">
          <div class="card">
              <div class="card-header">Filtros</div>
                 <filters-component></filters-component>
              <div class="card-body">
              </div>
          </div>
        </div> --}}
    </div>
</div>
@endsection
