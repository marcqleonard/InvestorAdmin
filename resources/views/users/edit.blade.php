@extends('shared.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ url('/css/dashboard.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('/css/sidebar.css') }}" />
@endsection

@section('title', 'Edit')

@section('sidebar')
    @include('users.singleUserSidebar')
@endsection

@section('breadcrump')
    <a href="{{ route('users.index') }}"><i class="fa fa-chevron-circle-left pr-md-1" aria-hidden="true"></i>Back</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <img src="{{ $user->gravatarUrl }}">
        </div>
        <div class="col-md-8">
            <form method="POST" action="{{ route('users.update', ['id' => $user->id]) }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" value="{{ $user->email }}" required>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" value="{{ $user->displayName }}" required>
                </div>
                <div class="form-group">
                    <label for="level">Select level</label>
                    <select class="form-control" id="level" name="level" required>
                        <option {{ $user->level == "Investor" ? "selected" : '' }}>Investor</option>
                        <option {{ $user->level == "Administrator" ? "selected" : '' }}>Administrator</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block">Save changes</button>
            </form>
        </div>
    </div>

@endsection