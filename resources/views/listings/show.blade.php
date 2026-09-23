@extends('layouts.app')

@section('title', $listing->name)

@section('content')

<div class="max-w-4xl mx-auto px-4 py-8">

    @if(session('success'))

        <div class="bg-green-100 text-green-800 p-4 rounded mb-6">
            {{ session('success') }}
        </div>

    @endif

    <div class="bg-white rounded-lg shadow p-6">

        <div class="flex justify-between items-start">

            <div>

                <span class="text-sm text-gray-500">
                    {{ ucfirst($listing->type) }}
                </span>

                <h1 class="text-3xl font-bold mt-2">
                    {{ $listing->name }}
                </h1>

            </div>

            <div class="text-2xl font-bold text-blue-600">
                ₹{{ number_format($listing->price, 2) }}
            </div>

        </div>


        <hr class="my-6">


        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>

                <h3 class="font-semibold">
                    Category
                </h3>

                <p>
                    {{ $listing->category->name }}
                    →
                    {{ $listing->subcategory->name }}
                </p>

            </div>


            <div>

                <h3 class="font-semibold">
                    Location
                </h3>

                <p>
                    {{ $listing->area->name }},
                    {{ $listing->city->name }},
                    {{ $listing->state->name }},
                    {{ $listing->country->name }}
                </p>

            </div>


            <div>

                <h3 class="font-semibold">
                    Seller
                </h3>

                <p>
                    {{ $listing->user->name }}
                </p>

            </div>


            <div>

                <h3 class="font-semibold">
                    Posted
                </h3>

                <p>
                    {{ $listing->created_at->format('d M Y') }}
                </p>

            </div>

        </div>


        <hr class="my-6">


        <div>

            <h2 class="text-xl font-bold mb-3">
                Details
            </h2>

            <p class="text-gray-700 whitespace-pre-line">
                {{ $listing->detail }}
            </p>

        </div>


        @auth

            @if(auth()->id() === $listing->user_id)

                <div class="mt-8 flex gap-3">

                    <a
                        href="{{ route('listings.edit', $listing) }}"
                        class="bg-yellow-500 text-white px-5 py-2 rounded"
                    >
                        Edit Listing
                    </a>

                    <form
                        method="POST"
                        action="{{ route('listings.destroy', $listing) }}"
                        onsubmit="return confirm('Delete this listing?')"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="bg-red-600 text-white px-5 py-2 rounded"
                        >
                            Delete
                        </button>

                    </form>

                </div>

            @endif

        @endauth

    </div>

</div>

@endsection