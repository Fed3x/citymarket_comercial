@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-end">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Perfiles</div>

                <div class="card-body">
                    <perfiles-component></perfiles-component>
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
