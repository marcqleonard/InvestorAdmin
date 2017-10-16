@extends('shared.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ url('/css/dashboard.css') }}" />
@endsection

@section('title', 'Edit User')

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

    <a href="{{ URL::previous() }}"><i class="fa fa-chevron-circle-left pr-md-1" aria-hidden="true"></i>Back</a>

    <div class="row">
        <div class="col-md-6 mx-auto">
            <h3>{{ $user->id }}</h3>
            <form method="POST" action="{{ route('users.update', ['id' => $user->id]) }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" value="{{ $user->email }}">
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" value="{{ $user->displayName }}">
                </div>
                <div class="form-group">
                    <label for="level">Select level</label>
                    <select class="form-control" id="level" name="level">
                        <option {{ $user->level == "Investor" ? "selected" : '' }}>Investor</option>
                        <option {{ $user->level == "Administrator" ? "selected" : '' }}>Administrator</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block">Save changes</button>
            </form>
        </div>
    </div>


    <div class="row row pt-md-4">
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
@endsection