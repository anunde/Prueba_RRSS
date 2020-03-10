@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('includes.message')

        @foreach($images as $image)
            <div class="card pub_image">
                <div class="card-header user_desc">
                    @if($image->user->image)
                        <div class="container-avatar">
                            <img src="{{ route('user.avatar',['filename' => $image->user->image]) }}" class="avatar">
                        </div>
                    @endif
                    <div class="data-user">{{'@'.$image->user->nick}}</div>
                </div>

                <div class="card-body">
                    <div class="image-container">
                        <a href="{{ route('image.detail', ['id' => $image->id]) }}">
                            <img src="{{ route('image.file', ['filename' => $image->image_path]) }}">
                        </a>
                    </div>
                    <div class="likes">
                        <img src="{{asset('img/heart.png')}}">
                    </div>
                    <div class="description">
                        <p><span class="nickname">{{'@'.$image->user->nick}}</span> {{ $image->description }}</p>
                    </div>
                    <div class="comments">
                        <a href="" class="btn btn-sm btn-comments">
                            @if(count($image->comments) == 0)
                                No hay comentarios
                            @elseif(count($image->comments) == 1)
                                Ver el comentario
                            @elseif(count($image->comments) >= 2)
                                Ver los {{count($image->comments)}} comentarios
                            @endif
                        </a>                        
                    </div>
                    <div class="date">
                        <p>{{ \FormatTime::LongTimeFilter($image->created_at) }}</p>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- PAGINACIÓN -->

        <div class="clearfix"></div>
        {{$images->links()}}
        </div>

    </div>
</div>
@endsection
