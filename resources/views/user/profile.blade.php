@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

        	<div class="data-user perfil">

        		@if($user->image)
                	<div class="container-avatar">
                    	<img src="{{ route('user.avatar',['filename' => $user->image]) }}" class="avatar">
                	</div>
            	@else
                    <div class="container-avatar">
                        <img src="{{asset('img/profile.png')}}" class="avatar">
                    </div>
                @endif

            	<div class="user-info">
            		<h1>{{ '@'.$user->nick }}</h1>
            		<h2>{{ $user->name.' '.$user->surname }}</h2>
            		<p>{{ 'Se unió '.\FormatTime::LongTimeFilter($user->created_at) }}</p>
            	</div>
        	</div>

        @if($images && count($images) >=1 )
            @foreach($images as $image)
                @include('includes.image', ['image'=>$image])
            @endforeach
        @else
            <hr>
            <h1 class="sin-publicaciones">"Este usuario todavía no tiene publicaciones"</h1>
        @endif

    </div>
</div>
@endsection