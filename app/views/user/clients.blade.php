@extends('layouts.default')
@section('content')
    @include('includes.alert')


    <div class="panel-body">
        <table class="display table table-bordered table-stripe" id="example">
            <thead>
            <tr>
                <th>Client Id</th>
                <th>Client Avatar</th>
                <th>Client Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Company</th>
                <th>Paypal Id</th>
                <th>Contact</th>
                <th>Joined</th>

                <th class="text-center">Action</th>

            </tr>
            </thead>
            <tbody>
            @foreach($clientsInfo as $Info)

                <tr class="">
                    <td>{{$Info->id}}</td>
                    <td>{{ HTML::image($Info->userInfo->icon_url, 'alt', array()) }}</td>
                    <td>{{$Info->userInfo->fullName}}</td>
                    <td>{{$Info->email}}</td>
                    <td>{{$Info->userInfo->address}}</td>
                    <td>{{$Info->userInfo->company}}</td>
                    <td>{{$Info->userInfo->paypal_id}}</td>
                    <td>{{$Info->userInfo->contact}}</td>
                    <td>{{$Info->created_at->diffForHumans()}}</td>

                    <td class="text-center">
                        <a class="btn btn-xs btn-success btn-edit" href="{{ URL::route('show.profile',$Info->userInfo->user_id) }}">details</a>
                    </td>


                </tr>

            @endforeach
            </tbody>
        </table>
    </div>


@stop

@section('style')
    {{ HTML::style('assets/data-tables/DT_bootstrap.css') }}

@stop


@section('script')
    {{ HTML::script('assets/data-tables/jquery.dataTables.js') }}
    {{ HTML::script('assets/data-tables/DT_bootstrap.js') }}

    <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {

            $('#example').dataTable({
            });
        });
    </script>
@stop