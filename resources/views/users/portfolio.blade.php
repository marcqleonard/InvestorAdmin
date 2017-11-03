@extends('shared.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ url('/css/dashboard.css?v=1.1') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('/css/sidebar.css?v=1.1') }}" />
@endsection

@section('scripts')
    <script src="{{ url('/js/positionColors.js') }}"></script>
@endsection

@section('title', 'Portfolio')

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
            @if(!empty($account))
                <h4>{{ $account->name }} (<small>{{ $account->id }}</small>)</h4>
                <p>Balance: ${{ $account->balance }}</p>
                <div class="row">
                    <div class="col-md-12 mx-auto">
                        <h5>Current positions</h5>
                        <table class="table table-responsive table-hover table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Symbol</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Avg Price</th>
                                    <th scope="col">Last Price</th>
                                    <th scope="col">Change</th>
                                    <th scope="col">Change %</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($account->positions as $position)
                                    <tr>
                                        <td>{{ $position->symbol }}</td>
                                        <td>{{ $position->name }}</td>
                                        <td>{{ $position->quantity }}</td>
                                        <td>{{ $position->averagePrice }}</td>
                                        <td>{{ $position->lastPrice }}</td>
                                        <td><span class="position-outcome">{{ $position->change }}</span></td>
                                        <td><span class="position-outcome">{{ $position->changePercent }}</span>%</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <p>No portfolio</p>
            @endif
        </div>
    </div>
@endsection