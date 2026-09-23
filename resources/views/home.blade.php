@extends('layouts.app')

@section('title', 'Marketplace')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-12">

    <div class="bg-white rounded-lg shadow p-10 text-center">

        <h1 class="text-4xl font-bold mb-4">
            Welcome to Marketplace
        </h1>

        <p class="text-gray-600 mb-8">
            Buy and sell products and services near you.
        </p>

        @guest

            <div class="flex justify-center gap-4">

                <a
                    href="{{ route('login') }}"
                    class="bg-blue-600 text-white px-6 py-3 rounded"
                >
                    Login
                </a>

                <a
                    href="{{ route('register') }}"
                    class="bg-gray-800 text-white px-6 py-3 rounded"
                >
                    Register
                </a>

            </div>

        @else

            <a
                href="{{ route('listings.create') }}"
                class="bg-blue-600 text-white px-6 py-3 rounded"
            >
                Post Your Listing
            </a>

        @endguest

    </div>

</div>

@endsection