@extends('layouts.default')
@section('content')
    @include('includes.alert')
    {{ Form::open(array('route' => 'post.paypal', 'method' => 'post', 'class' => 'form-signin')) }}
    <h2 class="form-signin-heading">Your Paypal Information</h2>
    <div class="login-wrap">
        @include('includes.alert')

        {{ Form::label('email', 'Paypal email', array('' => '')) }}
        {{ Form::text('email', $paypal_email, array('class' => 'form-control', 'placeholder' => 'Email Address', 'autofocus')) }}

        {{ Form::submit('Update', array('class' => 'btn btn-lg btn-login btn-block')) }}
    </div>

    {{ Form::close() }}
@stop