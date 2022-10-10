@extends('layouts.master')

@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="m-2">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>{{ __('You are logged in!') }}</p>
                    <p><span class="fw-bold">Nom d'usuari:</span> {{Auth::user()->name}}</p>
                    <p><span class="fw-bold">Email:</span> {{Auth::user()->email}}</p>
                    @if(Auth::user()->location)
                        <p><span class="fw-bold">Location:</span> {{Auth::user()->location}}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
