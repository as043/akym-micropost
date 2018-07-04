
    @if (Auth::user()->is_favoriting($user->id))
        {!! Form::open(['route' => ['micropost.unfavorite', $user->id], 'method' => 'destroy']) !!}
            {!! Form::submit('Unfavorite', ['class' => "btn btn-danger btn-block btn-xs"]) !!}
        {!! Form::close() !!}
    @else
        {!! Form::open(['route' => ['micropost.favorite', $user->id], 'method' => 'store']) !!}
            {!! Form::submit('Favorite', ['class' => "btn btn-primary btn-block btn-xs"]) !!}
        {!! Form::close() !!}
    @endif