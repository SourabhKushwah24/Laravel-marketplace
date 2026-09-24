<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Area;
use App\Http\Requests\StoreListingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class ListingController extends Controller
{
    public function index(Request $request): Response
    {
        $listings = Listing::query()
            ->with([
                'category',
                'subcategory',
                'city',
                'area',
            ])
            ->where('status', 'active')
            ->when(
                $request->search,
                fn($query, $search) =>
                $query->where('name', 'like', "%{$search}%")
            )
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return Inertia::render('Listings/Index', [
            'listings' => $listings,
            'filters' => $request->only('search'),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Listings/Create', [
            'categories' => Category::where('is_active', true)->get(),
            'countries' => Country::where('is_active', true)->get(),
        ]);
    }

    public function store(StoreListingRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = Auth::id();
        $data['slug'] = Str::slug($data['name']) . '-' . Str::random(8);
        $data['status'] = 'active';

        Listing::create($data);

        return redirect()
            ->route('listings.mine')
            ->with('success', 'Listing created successfully.');
    }

    public function show(Listing $listing): Response
    {
        $listing->load([
            'user',
            'category',
            'subcategory',
            'country',
            'state',
            'city',
            'area',
        ]);

        return Inertia::render('Listings/Show', [
            'listing' => $listing,
        ]);
    }

    public function myListings(): Response
    {
        $listings = Listing::with([
            'category',
            'subcategory',
            'city',
            'area',
        ])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return Inertia::render('Listings/Mine', [
            'listings' => $listings,
        ]);
    }

    public function edit(Listing $listing): Response
    {
        abort_unless(
            $listing->user_id === Auth::id(),
            403
        );

        Gate::authorize('update', $listing);

        return Inertia::render('Listings/Edit', [
            'listing' => $listing->load([
                'category',
                'subcategory',
                'country',
                'state',
                'city',
                'area',
            ]),
            'categories' => Category::where('is_active', true)->get(),
            'countries' => Country::where('is_active', true)->get(),
        ]);
    }

    public function update(Request $request, Listing $listing)
    {
        abort_unless(
            $listing->user_id === Auth::id(),
            403
        );

        $validated = $request->validate([
            'type' => ['required', 'in:product,service'],
            'name' => ['required', 'string', 'max:255'],
            'detail' => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'subcategory_id' => ['required', 'exists:subcategories,id'],
            'country_id' => ['required', 'exists:countries,id'],
            'state_id' => ['required', 'exists:states,id'],
            'city_id' => ['required', 'exists:cities,id'],
            'area_id' => ['required', 'exists:areas,id'],
            'price' => ['required', 'numeric', 'min:0'],
        ]);

        $listing->update($validated);

        return redirect()
            ->route('listings.mine')
            ->with('success', 'Listing updated successfully.');
    }

    public function destroy(Listing $listing)
    {
        abort_unless(
            $listing->user_id === Auth::id(),
            403
        );

        Gate::authorize('delete', $listing);

        $listing->delete();

        return back()->with(
            'success',
            'Listing deleted successfully.'
        );
    }

    public function category(Category $category): Response
    {
        $listings = Listing::with([
            'category',
            'subcategory',
            'city',
            'area',
        ])
            ->where('category_id', $category->id)
            ->where('status', 'active')
            ->latest()
            ->paginate(12);

        return Inertia::render('Listings/Index', [
            'listings' => $listings,
            'title' => $category->name,
        ]);
    }

    public function city(City $city): Response
    {
        $listings = Listing::with([
            'category',
            'subcategory',
            'city',
            'area',
        ])
            ->where('city_id', $city->id)
            ->where('status', 'active')
            ->latest()
            ->paginate(12);

        return Inertia::render('Listings/Index', [
            'listings' => $listings,
            'title' => $city->name,
        ]);
    }

    public function cityCategory(
        City $city,
        Category $category
    ): Response {
        $listings = Listing::with([
            'category',
            'subcategory',
            'city',
            'area',
        ])
            ->where('city_id', $city->id)
            ->where('category_id', $category->id)
            ->where('status', 'active')
            ->latest()
            ->paginate(12);

        return Inertia::render('Listings/Index', [
            'listings' => $listings,
            'title' => $city->name . ' - ' . $category->name,
        ]);
    }
}
