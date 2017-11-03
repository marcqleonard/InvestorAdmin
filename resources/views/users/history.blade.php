@extends('shared.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ url('/css/dashboard.css?v=1.1') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('/css/sidebar.css?v=1.1') }}" />
@endsection

@section('scripts')
    <script src="{{ url('/js/positionColors.js') }}"></script>
@endsection

@section('title', 'History')

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
                <dt>Email</dt>
                <dd>{{ $user->email }}</dd>
            </dl>

            <hr>

            @if(!empty($transactions))
                <div class="row">
                    <div class="col-md-12 mx-auto">
                        <h5>Transaction History</h5>
                        <table class="table table-responsive table-hover table-sm">
                            <thead>
                            <tr>
                                <th scope="col">UTC</th>
                                <th scope="col">Type</th>
                                <th scope="col">Description</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Balance</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $transaction)
                                    <tr>
                                        <td>{{ $transaction->timestampUtc }}</td>
                                        <td>{{ $transaction->type }}</td>
                                        <td>{{ $transaction->description }}</td>
                                        <td>{{ $transaction->amount }}</td>
                                        <td>${{ $transaction->balance }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <p>No history</p>
            @endif
        </div>
    </div>
@endsection