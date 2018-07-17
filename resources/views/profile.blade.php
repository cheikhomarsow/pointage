@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <p>Prénom Nom: <strong>{{ $user->firstname }} {{ $user->lastname }}</strong></p>
                <p>Matricule: <strong>{{ $user->matricule }}</strong></p>
                <p>Statut: <strong>Comptable</strong>
                <p>Heure de pointage: <strong> {{ $pointage->created_at }}</strong></p>
            </div>

            
        </div>
    </div>
</div>
@endsection
