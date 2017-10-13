@extends('shared.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ url('/css/dashboard.css') }}" />
@endsection

@section('title', 'Dashboard')

@section('content')
                <div class="row">
                    <div class="col-md-12">

                        @if(isset($status))
                            <div class="alert alert-info">
                                <ul>
                                    <li>{{ $status }}</li>
                                </ul>
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
                                <td><a class="btn btn-danger" href="{{ route('deleteUser', array('userId' => $user->id)) }}">Delete</a></td>
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
                                    <a class="page-link" href="{{ route('dashboard', array('pageNumber' => $pageNumber - 1, 'pageSize' => $pageSize)) }}" tabindex="-1">Previous</a>
                                </li>
                                @for ($i = 1; $i <= $totalPageCount; $i++)
                                    @if ($i == $pageNumber)
                                        <li class="page-item active">
                                            <a class="page-link" href="{{ route('dashboard', array('pageNumber' => $pageNumber, 'pageSize' => $pageSize)) }}">{{ $i }} <span class="sr-only">(current)</span></a>
                                        </li>
                                    @else
                                        <li class="page-item"><a class="page-link" href="{{ route('dashboard', array('pageNumber' => $i, 'pageSize' => $pageSize)) }}">{{ $i }}</a></li>
                                    @endif
                                @endfor
                                <li class="page-item {{ ($pageNumber == $totalPageCount) ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ route('dashboard', array('pageNumber' => $pageNumber + 1, 'pageSize' => $pageSize)) }}">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
@endsection