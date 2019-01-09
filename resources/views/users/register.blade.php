@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3" role="main">
                {!! Form::open(['url'=>'/user/register']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Name:') !!}
                    {!! Form::text('name', null, ['class'=> 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('email', 'Email:') !!}
                    {!! Form::text('email', null, ['class'=> 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('password', 'Password:') !!}
                    {!! Form::text('password', null, ['class'=> 'form-control']) !!}
                </div>
                 <div class="form-group">
                    {!! Form::label('password_confirmation', 'Password_confirmation:') !!}
                    {!! Form::text('password_confirmation', null, ['class'=> 'form-control']) !!}
                </div>
                {!! Form::submit('注册', ['class'=>'btn btn-success form-control']) !!}
                {!! Form::close() !!}
            </div> 
        </div>
    </div>
@stop