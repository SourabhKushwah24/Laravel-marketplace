@extends('layouts.app')

@section('title', 'My Listings')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-8">

    <div class="flex justify-between items-center mb-6">

        <h1 class="text-2xl font-bold">
            My Listings
        </h1>

        <a
            href="{{ route('listings.create') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded"
        >
            + Post Listing
        </a>

    </div>


    @if($listings->count() === 0)

        <div class="bg-white p-8 rounded shadow text-center">

            <p class="text-gray-600">
                You have not created any listings yet.
            </p>

            <a
                href="{{ route('listings.create') }}"
                class="inline-block mt-4 bg-blue-600 text-white px-5 py-2 rounded"
            >
                Create Your First Listing
            </a>

        </div>

    @else

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach($listings as $listing)

                <div class="bg-white rounded shadow p-5">

                    <div class="flex justify-between">

                        <h2 class="font-bold text-lg">
                            {{ $listing->name }}
                        </h2>

                        <span class="text-sm">
                            {{ ucfirst($listing->status) }}
                        </span>

                    </div>

                    <p class="text-blue-600 font-bold mt-3">
                        ₹{{ number_format($listing->price, 2) }}
                    </p>

                    <p class="text-gray-600 mt-2">
                        {{ $listing->category->name }}
                    </p>

                    <p class="text-gray-600">
                        {{ $listing->city->name }},
                        {{ $listing->area->name }}
                    </p>

                    <div class="mt-4 flex gap-2">

                        <a
                            href="{{ route('listings.show', $listing) }}"
                            class="bg-gray-800 text-white px-3 py-2 rounded text-sm"
                        >
                            View
                        </a>

                        <a
                            href="{{ route('listings.edit', $listing) }}"
                            class="bg-yellow-500 text-white px-3 py-2 rounded text-sm"
                        >
                            Edit
                        </a>

                        <form
                            method="POST"
                            action="{{ route('listings.destroy', $listing) }}"
                            onsubmit="return confirm('Are you sure you want to delete this listing?')"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="bg-red-600 text-white px-3 py-2 rounded text-sm"
                            >
                                Delete
                            </button>

                        </form>

                    </div>

                </div>

            @endforeach

        </div>

        <div class="mt-6">
            {{ $listings->links() }}
        </div>

    @endif

</div>

@endsection