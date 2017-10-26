@extends('shared.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ url('/css/dashboard.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('/css/sidebar.css') }}" />
@endsection

@section('title', 'Overview')

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
        @foreach($accounts as $account)
            <h4>{{ $account->name }} (<small>{{ $account->id }}</small>)</h4>
            <p>Balance: ${{ $account->balance }}</p>
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <table class="table table-responsive table-hover table-sm">
                        <thead>
                            <tr>
                                <td>Symbol</td>
                                <td>Name</td>
                                <td>Quantity</td>
                                <td>Avg Price</td>
                                <td>Last Price</td>
                                <td>Change</td>
                                <td>Change %</td>
                            </tr>
                        </thead>
                        @foreach($account->positions as $position)
                        <tbody>
                            <tr>
                                <td>{{ $position->symbol }}</td>
                                <td>{{ $position->name }}</td>
                                <td>{{ $position->quantity }}</td>
                                <td>{{ $position->averagePrice }}</td>
                                <td>{{ $position->lastPrice }}</td>
                                <td>{{ $position->change }}</td>
                                <td>{{ $position->changePercent }}</td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        @endforeach
        </div>
@endsection