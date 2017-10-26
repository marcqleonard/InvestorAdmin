<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">

    <a class="navbar-brand" href="#">
        <img src="{{ url('/images/logo512.png') }}" width="30" height="30" class="d-inline-block align-top" alt="">
        InvestorAdmin
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
            </li>
        </ul>


        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('authentication.logout') }}">Logout</a>
            </li>
        </ul>

    </div>
</nav>