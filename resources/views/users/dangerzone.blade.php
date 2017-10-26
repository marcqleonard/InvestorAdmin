@extends('shared.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ url('/css/dashboard.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('/css/sidebar.css') }}" />
@endsection

@section('title', 'Danger Zone')

@section('sidebar')
    @include('users.singleUserSidebar')
@endsection

@section('breadcrump')
    <a href="{{ route('users.index') }}"><i class="fa fa-chevron-circle-left pr-md-1" aria-hidden="true"></i>Back</a>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <dl class="dl-horizontal">
                <dt>Gravatar</dt>
                <dd><img src="{{ $user->gravatarUrl }}"></dd>
                <dt>Id</dt>
                <dd>{{ $user->id }}</dd>
                <dt>Email</dt>
                <dd>{{ $user->email }}</dd>
                <dt>Display Name</dt>
                <dd>{{ $user->displayName }}</dd>
                <dt>Level</dt>
                <dd>{{ $user->level }}</dd>
            </dl>

            <hr>
            <div class="row pt-md-4 pb-md-4">
                <div class="col-md-6 mx-auto">
                    <form method="POST" action="{{ route('users.delete', ['id' => $user->id]) }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <div class=form-group">
                            <input class="btn btn-danger btn-lg btn-block" type="submit" value="Delete user" id="delete-btn">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection