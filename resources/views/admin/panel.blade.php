@extends('layout-admin')

@section('title', @trans('title.admin'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">My panel</div>
                    <div class="panel-body">
                        <ul>
                            <li><a href="#">Edit profile</a></li>
                            <li><a href="#">Change password</a></li>
                            <p>
                            </p>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection