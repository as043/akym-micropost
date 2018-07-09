<ul clasuu="media-list">
    @foreach ($microposts as $micropost)
    <?php $user = $micropost->user; ?>
    
    <li class="media">
        <div class="media-left">
            <img class="media-object img-rounded" src="{{ Gravatar::src($user->email,50) }}" alt="">
        </div>
        <div class="media-body">
            <div>
                {!! link_to_route('users.show',$user->name,['id'=> $user->id]) !!}
                <span class="text-muted">posted at {{ $micropost->created_at }}</span>
                </div>
                <div>
                    <o>{!! nl2br(e($micropost->content)) !!}</o>
                </div>
                @if (Auth::user()->is_favoriting($micropost->id))
                    {!! Form::open(['route' => ['micropost.unfavorite', $micropost->id], 'method' => 'delete']) !!}
                    {!! Form::submit('Unfavorite', ['class' => 'btn btn-info btn-xs']) !!}
                    {!! Form::close() !!}
                @else
                    {!! Form::open(['route' => ['micropost.favorite', $micropost->id], 'method' => 'store']) !!}
                    {!! Form::submit('Favorite', ['class' => 'btn btn-warning btn-xs']) !!}
                    {!! Form::close() !!}
                @endif
            <div>
                @if (Auth::id() == $micropost->user_id)
                    {!! Form::open(['route' => ['microposts.destroy', $micropost->id],'method' => 'delete']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                    {!! Form::close() !!}

                @endif
            </div>
        </div>
    </li>
@endforeach
</ul>
{!! $microposts->render()  !!}

