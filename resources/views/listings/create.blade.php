@extends('layouts.app')

@section('title', 'Post Listing')

@section('content')

<div class="max-w-4xl mx-auto px-4 py-8">

    <div class="bg-white rounded-lg shadow p-6">

        <h1 class="text-2xl font-bold mb-6">
            Post Your Listing
        </h1>

        <form
            method="POST"
            action="{{ route('listings.store') }}"
        >

            @csrf

            {{-- Type --}}
            <div class="mb-4">

                <label class="block font-medium mb-2">
                    Product / Service
                </label>

                <select
                    name="type"
                    class="w-full border rounded px-3 py-2"
                    required
                >

                    <option value="">
                        Select Type
                    </option>

                    <option
                        value="product"
                        {{ old('type') === 'product' ? 'selected' : '' }}
                    >
                        Product
                    </option>

                    <option
                        value="service"
                        {{ old('type') === 'service' ? 'selected' : '' }}
                    >
                        Service
                    </option>

                </select>

                @error('type')
                    <p class="text-red-600 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Name --}}
            <div class="mb-4">

                <label class="block font-medium mb-2">
                    Name
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="w-full border rounded px-3 py-2"
                    placeholder="Enter product/service name"
                    required
                >

                @error('name')
                    <p class="text-red-600 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Detail --}}
            <div class="mb-4">

                <label class="block font-medium mb-2">
                    Detail
                </label>

                <textarea
                    name="detail"
                    rows="5"
                    class="w-full border rounded px-3 py-2"
                    placeholder="Enter details"
                    required
                >{{ old('detail') }}</textarea>

                @error('detail')
                    <p class="text-red-600 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Category --}}
            <div class="mb-4">

                <label class="block font-medium mb-2">
                    Category
                </label>

                <select
                    id="category_id"
                    name="category_id"
                    class="w-full border rounded px-3 py-2"
                    required
                >

                    <option value="">
                        Select Category
                    </option>

                    @foreach($categories as $category)

                        <option
                            value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}
                        >
                            {{ $category->name }}
                        </option>

                    @endforeach

                </select>

                @error('category_id')
                    <p class="text-red-600 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Subcategory --}}
            <div class="mb-4">

                <label class="block font-medium mb-2">
                    Subcategory
                </label>

                <select
                    id="subcategory_id"
                    name="subcategory_id"
                    class="w-full border rounded px-3 py-2"
                    required
                    disabled
                >

                    <option value="">
                        Select Subcategory
                    </option>

                </select>

                @error('subcategory_id')
                    <p class="text-red-600 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Country --}}
            <div class="mb-4">

                <label class="block font-medium mb-2">
                    Country
                </label>

                <select
                    id="country_id"
                    name="country_id"
                    class="w-full border rounded px-3 py-2"
                    required
                >

                    <option value="">
                        Select Country
                    </option>

                    @foreach($countries as $country)

                        <option
                            value="{{ $country->id }}"
                            {{ old('country_id') == $country->id ? 'selected' : '' }}
                        >
                            {{ $country->name }}
                        </option>

                    @endforeach

                </select>

                @error('country_id')
                    <p class="text-red-600 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- State --}}
            <div class="mb-4">

                <label class="block font-medium mb-2">
                    State
                </label>

                <select
                    id="state_id"
                    name="state_id"
                    class="w-full border rounded px-3 py-2"
                    required
                    disabled
                >

                    <option value="">
                        Select State
                    </option>

                </select>

                @error('state_id')
                    <p class="text-red-600 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- City --}}
            <div class="mb-4">

                <label class="block font-medium mb-2">
                    City
                </label>

                <select
                    id="city_id"
                    name="city_id"
                    class="w-full border rounded px-3 py-2"
                    required
                    disabled
                >

                    <option value="">
                        Select City
                    </option>

                </select>

                @error('city_id')
                    <p class="text-red-600 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Area --}}
            <div class="mb-4">

                <label class="block font-medium mb-2">
                    Area
                </label>

                <select
                    id="area_id"
                    name="area_id"
                    class="w-full border rounded px-3 py-2"
                    required
                    disabled
                >

                    <option value="">
                        Select Area
                    </option>

                </select>

                @error('area_id')
                    <p class="text-red-600 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Price --}}
            <div class="mb-6">

                <label class="block font-medium mb-2">
                    Price
                </label>

                <input
                    type="number"
                    name="price"
                    value="{{ old('price') }}"
                    min="0"
                    step="0.01"
                    class="w-full border rounded px-3 py-2"
                    placeholder="Enter price"
                    required
                >

                @error('price')
                    <p class="text-red-600 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            <button
                type="submit"
                class="bg-blue-600 text-white px-6 py-2 rounded"
            >
                Submit Listing
            </button>

        </form>

    </div>

</div>

@endsection

<script>

document.addEventListener('DOMContentLoaded', function () {

    const category = document.getElementById('category_id');
    const subcategory = document.getElementById('subcategory_id');

    const country = document.getElementById('country_id');
    const state = document.getElementById('state_id');
    const city = document.getElementById('city_id');
    const area = document.getElementById('area_id');


    /*
     * Category -> Subcategory
     */
    category.addEventListener('change', function () {

        const categoryId = this.value;

        resetSelect(
            subcategory,
            'Select Subcategory'
        );

        if (!categoryId) {
            return;
        }

        fetch(
            `/api/categories/${categoryId}/subcategories`
        )
            .then(response => response.json())
            .then(data => {

                data.forEach(item => {

                    const option =
                        document.createElement('option');

                    option.value = item.id;
                    option.textContent = item.name;

                    subcategory.appendChild(option);
                });

                subcategory.disabled = false;
            })
            .catch(error => {
                console.error(
                    'Subcategory error:',
                    error
                );
            });
    });


    /*
     * Country -> State
     */
    country.addEventListener('change', function () {

        const countryId = this.value;

        resetSelect(
            state,
            'Select State'
        );

        resetSelect(
            city,
            'Select City'
        );

        resetSelect(
            area,
            'Select Area'
        );

        if (!countryId) {
            return;
        }

        fetch(
            `/api/countries/${countryId}/states`
        )
            .then(response => response.json())
            .then(data => {

                data.forEach(item => {

                    const option =
                        document.createElement('option');

                    option.value = item.id;
                    option.textContent = item.name;

                    state.appendChild(option);
                });

                state.disabled = false;
            })
            .catch(error => {
                console.error(
                    'State error:',
                    error
                );
            });
    });


    /*
     * State -> City
     */
    state.addEventListener('change', function () {

        const stateId = this.value;

        resetSelect(
            city,
            'Select City'
        );

        resetSelect(
            area,
            'Select Area'
        );

        if (!stateId) {
            return;
        }

        fetch(
            `/api/states/${stateId}/cities`
        )
            .then(response => response.json())
            .then(data => {

                data.forEach(item => {

                    const option =
                        document.createElement('option');

                    option.value = item.id;
                    option.textContent = item.name;

                    city.appendChild(option);
                });

                city.disabled = false;
            })
            .catch(error => {
                console.error(
                    'City error:',
                    error
                );
            });
    });


    /*
     * City -> Area
     */
    city.addEventListener('change', function () {

        const cityId = this.value;

        resetSelect(
            area,
            'Select Area'
        );

        if (!cityId) {
            return;
        }

        fetch(
            `/api/cities/${cityId}/areas`
        )
            .then(response => response.json())
            .then(data => {

                data.forEach(item => {

                    const option =
                        document.createElement('option');

                    option.value = item.id;
                    option.textContent = item.name;

                    area.appendChild(option);
                });

                area.disabled = false;
            })
            .catch(error => {
                console.error(
                    'Area error:',
                    error
                );
            });
    });


    /*
     * Reset select helper
     */
    function resetSelect(
        select,
        placeholder
    ) {

        select.innerHTML = '';

        const option =
            document.createElement('option');

        option.value = '';
        option.textContent = placeholder;

        select.appendChild(option);

        select.disabled = true;
    }

});

</script>