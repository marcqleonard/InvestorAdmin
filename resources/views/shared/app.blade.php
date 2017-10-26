<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">

    {{--Boostrap--}}
    <script src="//code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

    @yield('css')
    @yield('scripts')
    <title>@yield('title')</title>

</head>
<body>

@if(session('isAuthenticated') == 'true')
    <header>
        @include('shared.navbar')
    </header>
@endif

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            @yield('sidebar')
        </div>
        <div class="col-md-10" id="main">
            <div class="row pt-md-2">
                <div class="col-md-12">
                    @yield('breadcrump')
                </div>
            </div>
            <div class="row pt-md-4 border-bottom-0">
                <div class="col-md-12" id="page">
                    <h1>@yield('title')</h1>
                </div>
            </div>
            @yield('content')
        </div>
    </div>
</div>

</body>
</html>