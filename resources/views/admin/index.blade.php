@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <p>Prénom Nom: <strong>{{ $user->firstname }} {{ $user->lastname }}</strong></p>
                <p>Statut: <strong>Admin</strong>
            </div>

            <p></p>

            <ul class="list-group">
                <li class="list-group-item disabled">Tableau de bord</li>
                <li class="list-group-item"><a href="{{ route('admin.allcomptables') }}">Comptables</a></li>
                <li class="list-group-item"><a href="{{ route('admin.allpointages') }}">Pointages</a></li>

            </ul>

            
        </div>
    </div>
</div>
@endsection
