@extends('shared.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ url('/css/dashboard.css?v=1.1') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('/css/sidebar.css?v=1.1') }}" />
@endsection

@section('title', 'Brokerage Fee')

@section('sidebar')
    @include('users.listUsersSidebar')
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
        <div class="col-md-12">
            <form method="POST" action="{{ route('brokerage.update') }}">
                {{ csrf_field() }}

                <h4>BUY COMMISSIONS</h4>

                <h5>Fixed</h5>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Min</th>
                            <th>Max</th>
                            <th>Fee</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach($buyFee->fixed as $buyFeeBracket)
                            <tr>
                                <td><input type="number" step="1" class="form-control" name="buyFixed[{{ $i }}][min]" value="{{ $buyFeeBracket->min }}"></td>
                                <td><input type="number" step="1" class="form-control" name="buyFixed[{{ $i }}][max]" value="{{ $buyFeeBracket->max }}"></td>
                                <td><input type="number" step="0.01" class="form-control" name="buyFixed[{{ $i }}][value]" value="{{ $buyFeeBracket->value }}"></td>
                            </tr>
                            <?php $i++; ?>
                        @endforeach
                    </tbody>
                </table>

                <h5>Variable</h5>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th>Min</th>
                                <th>Max</th>
                                <th>Fee</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                            @foreach($buyFee->percentage as $buyFeeBracket)
                                <tr>
                                    <td><input type="number" step="1" class="form-control" name="buyPercentage[{{ $i }}][min]" value="{{ $buyFeeBracket->min }}"></td>
                                    <td><input type="number" step="1" class="form-control" name="buyPercentage[{{ $i }}][max]" value="{{ $buyFeeBracket->max }}"></td>
                                    <td><input type="number" step="0.01" class="form-control" name="buyPercentage[{{ $i }}][value]" value="{{ $buyFeeBracket->value }}"></td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <hr>

                <h4>SELL COMMISSIONS</h4>

                <h5>Fixed</h5>
                <table class="table table-sm">
                    <thead>
                    <tr>
                        <th>Min</th>
                        <th>Max</th>
                        <th>Fee</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 0; ?>
                    @foreach($sellFee->fixed as $sellFeeBracket)
                        <tr>
                            <td><input type="number" step="1" class="form-control" name="sellFixed[{{ $i }}][min]" value="{{ $sellFeeBracket->min }}"></td>
                            <td><input type="number" step="1" class="form-control" name="sellFixed[{{ $i }}][max]" value="{{ $sellFeeBracket->max }}"></td>
                            <td><input type="number" step="0.01" class="form-control" name="sellFixed[{{ $i }}][value]" value="{{ $sellFeeBracket->value }}"></td>
                        </tr>
                        <?php $i++; ?>
                    @endforeach
                    </tbody>
                </table>

                <h5>Variable</h5>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th>Min</th>
                                <th>Max</th>
                                <th>Fee</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                            @foreach($sellFee->percentage as $sellFeeBracket)
                                <tr>
                                    <td><input type="number" step="1" class="form-control" name="sellPercentage[{{ $i }}][min]" value="{{ $sellFeeBracket->min }}"></td>
                                    <td><input type="number" step="1" class="form-control" name="sellPercentage[{{ $i }}][max]" value="{{ $sellFeeBracket->max }}"></td>
                                    <td><input type="number" step="0.01" class="form-control" name="sellPercentage[{{ $i }}][value]" value="{{ $sellFeeBracket->value }}"></td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row pb-md-4">
                    <div class="col-md-6 mx-auto">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection