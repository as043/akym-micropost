
    @if (Auth::user()->is_favoriting($user->id))
        {!! Form::open(['route' => ['micropost.unfavorite', $micropost->id], 'method' => 'destroy']) !!}
            {!! Form::submit('Unfavorite', ['class' => "btn btn-danger btn-block btn-xs"]) !!}
        {!! Form::close() !!}
    @else
        {!! Form::open(['route' => ['micropost.favorite', $micropost->id], 'method' => 'store']) !!}
            {!! Form::submit('Favorite', ['class' => "btn btn-primary btn-block btn-xs"]) !!}
        {!! Form::close() !!}
    @endif