@extends('shared.app')

@section('title', 'Login')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection