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

           <p></p>

            <div class="card">
            <ul class="list-group">
                <li class="list-group-item active">Comptables</li>
                @if($comptables->count() > 0) 
                    @foreach($comptables as $comptable)
                        <li class="list-group-item"><a href="{{ route('admin.comptable', $comptable->matricule) }}">{{ $comptable->firstname }} {{ $comptable->lastname }}</a></li>
                    @endforeach
                @else 
                    <li class="list-group-item">Pas de comptables...</li>
                @endif
                
              
            </ul>
                
            </div>
        </div>
    </div>
</div>
@endsection
