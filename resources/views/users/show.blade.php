@extends('shared.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ url('/css/dashboard.css?v=1.1') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('/css/sidebar.css?v=1.1') }}" />
@endsection

@section('scripts')
    <script src="{{ url('/js/positionColors.js') }}"></script>
@endsection

@section('title', 'Overview')

@section('sidebar')
    @include('users.singleUserSidebar')
@endsection

@section('breadcrump')
    <a href="{{ route('users.index') }}"><i class="fa fa-chevron-circle-left pr-md-1" aria-hidden="true"></i>Back</a>
@endsection

@section('content')

    @include('users.miniNav')

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

        </div>
    </div>
@endsection