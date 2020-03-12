@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

        <h1 class="sugerencia">Sugerencias</h1>
        <form id="buscador" method="GET" action="{{ route('users') }}">
            <div class="row buscar">
                <div class="form-group col buscador">
                    <input type="text" id="search" class="form-control">
                </div>
                <div class="form-group col btn-search buscador">
                    <input type="submit" id="buscar" class="btn btn-success" value="Buscar">
                </div>
            </div>
        </form>

        @foreach($users as $user)
            <div class="data-user cuenta">
                <div class="left">
                @if($user->image)
                    <div class="container-avatar">
                        <img src="{{ route('user.avatar',['filename' => $user->image]) }}" class="avatar">
                    </div>
                @else
                    <div class="container-avatar">
                        <img src="{{asset('img/profile.png')}}" class="avatar">
                    </div>
                @endif

                <div class="user-info informacion-cuenta">
                    <h1>{{ '@'.$user->nick }}</h1>
                    <h2>{{ $user->name.' '.$user->surname }}</h2>
                    <p>{{ 'Se unió '.\FormatTime::LongTimeFilter($user->created_at) }}</p>
                </div>
                </div>
                <div class="right">
                    <a class="btn btn-sm btn-primary" href="{{ route('profile', ['id' => $user->id]) }}">Ver Perfil</a>
                </div>
            </div>
        @endforeach

    </div>
</div>
@endsection