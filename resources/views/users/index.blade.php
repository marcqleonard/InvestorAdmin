@extends('shared.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ url('/css/dashboard.css') }}" />
@endsection

@section('title', 'Users')

@section('content')
                <div class="row">
                    <div class="col-md-12">

                        @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif

                        <table class="table table-responsive table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Email</th>
                                <th>Name</th>
                                <th>Level</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->displayName }}</td>
                                <td>{{ $user->level }}</td>
                                <td>
                                    <a class="btn btn-warning" href="{{ route('users.show', ['id' => $user->id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <nav aria-label="...">
                            <ul class="pagination justify-content-center">
                                <li class="page-item {{ ($pageNumber == 1) ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ route('users.index', array('page' => $pageNumber - 1, 'size' => $pageSize)) }}" tabindex="-1">Previous</a>
                                </li>
                                @for ($i = 1; $i <= $totalPageCount; $i++)
                                    @if ($i == $pageNumber)
                                        <li class="page-item active">
                                            <a class="page-link" href="{{ route('users.index', array('page' => $pageNumber, 'size' => $pageSize)) }}">{{ $i }} <span class="sr-only">(current)</span></a>
                                        </li>
                                    @else
                                        <li class="page-item"><a class="page-link" href="{{ route('users.index', array('page' => $i, 'size' => $pageSize)) }}">{{ $i }}</a></li>
                                    @endif
                                @endfor
                                <li class="page-item {{ ($pageNumber == $totalPageCount) ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ route('users.index', array('page' => $pageNumber + 1, 'size' => $pageSize)) }}">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
@endsection