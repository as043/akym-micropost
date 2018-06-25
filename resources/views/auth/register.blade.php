@extends('layouts.app')

@section('content')
    <dev class="text-center">
        <h1>sign up</h1>
    </dev>
    
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            
            {!! Form::open(['route'=> 'signup.post']) !!}
                <dev class="form-group">
                    {!! Form::label('name','NAME') !!}
                    {!! Form::text('name',old('name'),['class'=> 'form-control']) !!}
                </dev>
                
                <dev class="form-group">
                    {!! Form::label('email','Email') !!}
                    {!! Form::email('email',old('email'),['class'=> 'form-control']) !!}
                </dev>
                
                <dev class="form-group">
                    {!! Form::label('password','Password') !!}
                    {!! Form::password('password',['class'=> 'form-control']) !!}
                </dev>
                
                <dev class="form-group">
                    {!! Form::label('password_confirmation','confirmation') !!}
                    {!! Form::password('password_confirmation',['class'=> 'form-control']) !!}
                </dev>
                
            {!! Form::submit('Sign up',['class'=> 'btn btn-primary btn-block']) !!}
        {!! Form::close() !!}
        </div>
    </div>
@endsection
