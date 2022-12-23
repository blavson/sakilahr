<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li>
                    <form class="d-flex" role="search" method='POST' action="{{ route('employees.search') }}">
                        @csrf
                        <input class="form-control me-2" type="search"  name="searchString"  value="{{ old('searchString') }}" aria-label="Search">
                        <button class="btn btn-outline-primary" type="submit">Search</button>
                    </form>
                </li>
            </ul>
            @guest()
                <div class="nav-item">
                    <a class="nav-link" href="{{url('login')}}">Login</a>
                </div>
                <div class="mx-3 nav-item">
                    <a class="nav-link">Sign Up</a>
                </div>
            @endguest
            @auth
                <div class="nav-item">
                    <a class="nav-link" href="{{url('logout')}}">Logout</a>
                </div>
            @endauth
        </div>
    </div>
</nav>
