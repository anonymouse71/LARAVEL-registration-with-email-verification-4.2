@extends('layouts.default')
@section('content')
    @include('includes.alert')
    {{ Form::model($users, array('route' => 'user.update', 'method' => 'post', 'role' => 'form')) }}
    <h2 class="form-signin-heading">Update Profile</h2>
    <div class="panel-body">
        {{ Form::label('fullName', 'Full Name', array('' => '')) }}
        {{ Form::text('fullName', null, array('class' => 'form-control', 'autofocus')) }}

        {{ Form::label('address', 'Address', array('' => '')) }}
        {{ Form::text('address', null, array('class' => 'form-control', 'autofocus')) }}

        {{ Form::label('company', 'Company', array('' => '')) }}
        {{ Form::text('company', null, array('class' => 'form-control', 'autofocus')) }}

        {{ Form::label('contact', 'Contact no', array('' => '')) }}
        {{ Form::text('contact', null, array('class' => 'form-control', 'autofocus')) }}

        {{ Form::hidden('id',$users->id) }}
        {{ Form::submit('Update', array('class' => 'btn btn-lg btn-login btn-block')) }}
    </div>



    {{ Form::close() }}


@stop
