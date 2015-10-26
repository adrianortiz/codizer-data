@extends('layout-admin')

@section('title', @trans('title.home'))

@section('content')

    <!-- REVISAR -->
    <div class="head-menu">
        <h1><span><img src="/images/icon-complements.svg"></span> <span> > </span> GESTIONAR DATOs: COLECCIÓN {{ $form->name  }}</h1>
        @include('admin.colections.complements.partials.menu')
    </div>


    <table class="table table-condensed">
        <thead>
        <tr>
            <th>#</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Username</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
            <td>@fat</td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td colspan="2">Larry the Bird</td>
            <td>@twitter</td>
        </tr>
        </tbody>
    </table>

@endsection


@section('scripts')
    <!-- <script src="{{ asset('/js/form.js') }}"></script> -->
@endsection