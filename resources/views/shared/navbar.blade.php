<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">

    <a class="navbar-brand" href="{{ route('users.index') }}">
        <img src="{{ url('/images/logo512.png') }}" width="30" height="30" class="d-inline-block align-top" alt="">
        InvestorAdmin
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav mr-auto">
            <li class="nav-item d-md-none d-xs-block">
                <a class="nav-link {{ Request::is('*users') ? 'active' : '' }}" href="{{ route('users.index') }}">All Users</a>
            </li>
            <li class="nav-item d-md-none d-xs-block">
                <a class="nav-link {{ Request::is('*brokerage*') ? 'active' : '' }}" href="{{ route('brokerage.edit') }}">Brokerage Fee</a>
            </li>
        </ul>

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('authentication.logout') }}">Logout</a>
            </li>
        </ul>

    </div>
</nav>