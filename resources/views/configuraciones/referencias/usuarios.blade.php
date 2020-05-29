@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-end">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Usuarios</div>

                <div class="card-body">
                    <usuarios-component></usuarios-component>
                </div>
            </div>
        </div>
        {{-- <div class="col-md-2">
          <div class="card">
              <div class="card-header">Filters</div>
                  <filters-component></filters-component>
              <div class="card-body">
              </div>
          </div>
        </div> --}}
    </div>
</div>
@endsection
