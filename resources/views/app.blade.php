<!DOCTYPE html>
<html>

<head>
    <title>Product Recommender</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <header class="bg-dark py-3">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-6">
                <div class="col-md-6">
                    <h1 class="text-white">Product Recommender</h1>
                </div>

                @if(Auth::check())
                <div class="d-flex justify-content-between align-items-center mb-6">
                    <form method="POST" action="{{ route('logout') }}" >
                        @csrf
                        <button type="bu" class="btn btn-sm btn-danger me-3">Logout ({{ Auth::user()->name }})</button>
                    </form>
                    <a class="btn btn-sm btn-info " href="{{ route('wishlist.index') }}" >Wishlist</a>
                </div>

                @else

                <a href="{{ route('login') }}" class="btn btn-sm btn-primary">Login</a>
                <a href="{{ route('register') }}" class="btn btn-sm btn-secondary">Register</a>

                @endif
            </div>

        </div>
    </header>
    <div class="container mt-4">
        @yield('content')
    </div>
</body>

</html>