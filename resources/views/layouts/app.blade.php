<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'Marketplace')
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>

<body class="bg-gray-100 text-gray-900">

    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between">

            <a
                href="{{ route('home') }}"
                class="text-xl font-bold"
            >
                Marketplace
            </a>

            <div class="flex gap-4">

                @auth

                    <a href="{{ route('listings.create') }}">
                        Post Listing
                    </a>

                    <a href="{{ route('listings.mine') }}">
                        My Listings
                    </a>

                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                    >
                        @csrf

                        <button type="submit">
                            Logout
                        </button>
                    </form>

                @else

                    <a href="{{ route('login') }}">
                        Login
                    </a>

                    <a href="{{ route('register') }}">
                        Register
                    </a>

                @endauth

            </div>

        </div>
    </nav>

    @if(session('success'))

        <div class="max-w-7xl mx-auto mt-4 px-4">
            <div class="bg-green-100 text-green-800 p-4 rounded">
                {{ session('success') }}
            </div>
        </div>

    @endif

    @if(session('error'))

        <div class="max-w-7xl mx-auto mt-4 px-4">
            <div class="bg-red-100 text-red-800 p-4 rounded">
                {{ session('error') }}
            </div>
        </div>

    @endif

    <main>
        @yield('content')
    </main>

</body>
</html>