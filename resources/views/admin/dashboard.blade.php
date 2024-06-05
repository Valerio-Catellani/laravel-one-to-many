@section('title', 'Admin Dashboard')
@extends('layouts.admin')


@section('content')
    <div class="container">
        <h2 class="mt-4">Benvenuto nell'area amministrativa!</h2>
        <p>Questo è un esempio di un template dettagliato per una pagina di amministrazione.</p>

        <div class="container my-4">
            <h2 class="fs-4 text-secondary my-4">
                {{ __('Dashboard') }}
            </h2>
            <div class="row justify-content-center">
                <div class="col">
                    <div class="card">
                        <div class="card-header">{{ __('User Dashboard') }}</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            {{ __('You are logged in!') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Statistiche Utenti</div>
                    <div class="card-body">
                        <p>Numero totale di utenti: <strong>100</strong></p>
                        <p>Utenti attivi: <strong>80</strong></p>
                        <p>Utenti inattivi: <strong>20</strong></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Prodotti Popolari</div>
                    <div class="card-body">
                        <p>Prodotto 1</p>
                        <p>Prodotto 2</p>
                        <p>Prodotto 3</p>
                    </div>
                </div>
            </div>
        @endsection
