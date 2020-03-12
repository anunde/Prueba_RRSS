<div class="card pub_image">
                <div class="card-header user_desc">
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

                <div class="card-body">
                    <div class="image-container">
                        <a href="{{ route('image.detail', ['id' => $image->id]) }}">
                            <img src="{{ route('image.file', ['filename' => $image->image_path]) }}">
                        </a>
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
                        <a href="{{ route('image.detail', ['id' => $image->id]) }}" class="btn btn-sm btn-comments">
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