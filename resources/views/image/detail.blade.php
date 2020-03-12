@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('includes.message')

            <div class="card pub_image pub_image_detail">
                <div class="card-header pub_menu">
                    <div class="left">
                    @if($image->user->image)
                        <div class="container-avatar">
                            <img src="{{ route('user.avatar',['filename' => $image->user->image]) }}" class="avatar">
                        </div>
                    @endif
                    <div class="data-user">
                        <a href="{{ route('profile', ['id' => $image->user->id]) }}">
                            {{'@'.$image->user->nick}}                            
                        </a>
                    </div>
                    </div>
                    @if(Auth::user() && Auth::user()->id == $image->user->id)
                    <div class="right">
                    <div class="actions">
                        <a href="{{ route('image.edit', ['id' => $image->id]) }}" class="btn btn-sm btn-primary">Actualizar</a>
                        <!-- Button to Open the Modal -->
                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#myModal">
                            Eliminar
                        </button>

                        <!-- The Modal -->
                        <div class="modal" id="myModal">
                        <div class="modal-dialog">
                            <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">¿Estas seguro?</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                Si eliminas la publicación no podrás recuperarla. ¿Quieres continuar?
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <a href="{{ route('image.delete', ['id' => $image->id]) }}" class="btn btn-sm btn-danger">Borrar definitivamente</a>
                                <button type="button" class="btn btn-sm btn-success" data-dismiss="modal">Cancelar</button>
                            </div>

                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                    @endif
                </div>

                <div class="card-body">
                    <div class="image-container image-detail">
                        <img src="{{ route('image.file', ['filename' => $image->image_path]) }}">
                    </div>
                    <div class="likes">
                        <!-- Comprobar si el usuario loggeado ha dado like a la publicación -->
                        <?php $user_like = false; ?>
                        @foreach($image->likes as $like)
                            @if($like->user->id == Auth::user()->id)
                                <?php $user_like = true; ?>
                            @endif
                        @endforeach

                        @if($user_like)
                            <img class="btn-like" src="{{asset('img/heart-red.png')}}" data-id="{{$image->id}}">
                        @else
                            <img class="btn-dislike" src="{{asset('img/heart.png')}}" data-id="{{$image->id}}">
                        @endif

                        <span class="like">{{ count($image->likes) }} Me gusta</span>
                    </div>
                    <div class="description">
                        <p><span class="nickname">{{'@'.$image->user->nick}}</span> {{ $image->description }}</p>
                    </div>
                    <div class="comments">
                            @if(count($image->comments) == 0)
                                <h2>No hay comentarios</h2>
                            @elseif(count($image->comments) == 1)
                                <h2>Comentario</h2><hr>
                            @elseif(count($image->comments) >= 2)
                                <h2>Comentarios ({{count($image->comments)}})</h2><hr>
                            @endif

                            @foreach($image->comments as $comment)

                                <div class="comment">
                                    <p><span class="nickname">{{'@'.$comment->user->nick}}</span> {{ $comment->content }} 
                                    @if(Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id))
                                        <a href="{{ route('comment.delete', ['id' => $comment->id]) }}" class="delete-comment">X</a>
                                    @endif
                                    <span class="comment-date">{{ \FormatTime::LongTimeFilter($comment->created_at) }}</span></p>
                                </div>

                            @endforeach         

                            <form method="POST" action="{{ route('comment.save') }}">
                                @csrf

                                <input type="hidden" name="image_id" value="{{$image->id}}">
                                <p>
                                    <textarea class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content" placeholder="Escribe un comentario a esta publicación"></textarea>
                                    @if($errors->has('content'))
                                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('content') }}</strong></span>
                                    @endif
                                </p>
                                <button type="submit" class="btn btn-primary btn-comment">Enviar</button>
                            </form>     
                    </div>
                    <div class="date">
                        <p>{{ \FormatTime::LongTimeFilter($image->created_at) }}</p>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection