@extends('layouts.default')
@section('content')
    @include('includes.alert')

    <div class="col-md-9">
        <section class="panel">
            <div class="panel-body">
                <div class="col-md-6">
                    <div class="pro-img-details">
                        {{ HTML::image(Auth::user()->userInfo->avatar_url, 'alt', array()) }}
                        <a href="{{route('upload.avatar')}}"><button type="button" class="btn btn-info"><i class="fa fa-image"></i> Change Profile Image</button></a>
                    </div>
                </div>
                <div class="col-md-6">
                    <h4 class="pro-d-title">
                      <p>  {{Auth::user()->userInfo->fullName}} ( {{Auth::user()->user_name}}) </p>
                    </h4>
                    <h5>
                        {{Auth::user()->email}}
                    </h5>
                    <div class="product_meta">
                        <span class="posted_in"> <strong>Address:</strong> {{Auth::user()->userInfo->address}}</span>
                        <span class="tagged_as"><strong>Company:</strong> {{Auth::user()->userInfo->company}}</span>

                    </div>
                    <div class="m-bot15"> <strong>Contact : </strong> <span>{{Auth::user()->userInfo->contact}}</span></div>

                    <p class="product_meta">
                        <a href="{{route('user.edit')}}"><button class="btn btn-round btn-danger" type="button"><i class="fa fa-pencil"></i> Edit Profile</button></a>
                    </p>
                </div>
            </div>
        </section>
    </div>
@stop